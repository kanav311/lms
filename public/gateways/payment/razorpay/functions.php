<?php

require_once 'gateways/payment/razorpay/lib/razorpay-php/Razorpay.php';

use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

function aiipltech_pay(){
  $cart = getCart();
  $method = $cart->getPaymentMethod();
  $code = $method->directory;
  $invoice= $cart->getInvoiceObject();
  $transaction = $cart->getTransaction();
  $keyId= paymentOption($code,'key_id');
  $api = new Api($keyId,paymentOption($code,'key_secret'));
  $user = Auth::user();
  $displayCurrency = $invoice->currency->country->currency_code;
    $orderData = [
        'receipt'         => $transaction->id,
        'amount'          => $invoice->amount * 100, // 2000 rupees in paise
        'currency'        => $invoice->currency->country->currency_code,
        'payment_capture' => 1 // auto capture
    ];

    try{
        $razorpayOrder = $api->order->create($orderData);
    }
    catch (\Exception $exception){
        flashMessage($exception->getMessage());
        return back();
    }


    $razorpayOrderId = $razorpayOrder['id'];

    request()->session()->put('razorpay_order_id',$razorpayOrderId);

    $displayAmount = $amount = $orderData['amount'];


    $data = [
        "key"               => $keyId,
        "amount"            => $amount,
        "name"              => setting('general_site_name'),
        "description"       => __lang('invoice-payment',['invoice'=>$invoice->id]),
        "prefill"           => [
            "name"              => $user->name,
            "email"             => $user->email,
            "contact"           => $user->student?$user->student->mobile_number:'',
        ],
        "order_id"          => $razorpayOrderId,
    ];

    if ($displayCurrency !== 'INR')
    {
        $data['display_currency']  = $displayCurrency;
        $data['display_amount']    = $displayAmount;
    }

  return view("payment.{$code}.views.pay",compact('cart','method','invoice','code','transaction','data','displayCurrency'));
}
function aiipltech_callback(){
    $cart = getCart();
    $method = $cart->getPaymentMethod();
    $code = $method->directory;
    $request = request();
    $keyId= paymentOption($code,'key_id');
    $keySecret= paymentOption($code,'key_secret');
    $success = true;

    $error = "Payment Failed";
    if (empty($_POST['razorpay_payment_id']) === false)
    {
        $api = new Api($keyId, $keySecret);

        try
        {
            // Please note that the razorpay order ID must
            // come from a trusted source (session here, but
            // could be database or something else)
            $attributes = array(
                'razorpay_order_id' => $request->session()->get('razorpay_order_id'),
                'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                'razorpay_signature' => $_POST['razorpay_signature']
            );

            $api->utility->verifyPaymentSignature($attributes);

        }
        catch(SignatureVerificationError $e)
        {
            $success = false;
            $error = 'Razorpay Error : ' . $e->getMessage();
        }
    }
    else{
        $success = false;
    }


    if ($success === true)
    {
        $cart->approve(Auth::id());
        $message = __lang('payment-completed');
        flashMessage($message);
        return redirect()->route('student.student.mysessions');
    }
    else
    {
        flashMessage(__lang('payment-unsuccessful').$error);
        return redirect()->route('cart');
    }



}

