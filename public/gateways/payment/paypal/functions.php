<?php

use Illuminate\Support\Facades\Http;

function aiipltech_pay(){
  $cart = getCart();
  $method = $cart->getPaymentMethod();
  $code = $method->directory;
  $invoice= $cart->getInvoiceObject();
  $user = \Illuminate\Support\Facades\Auth::user();
  $options = [];
  if(!empty(paymentOption($code,'venmo'))){
      $options[] = 'venmo';
  }
    if(!empty(paymentOption($code,'paylater'))){
        $options[] = 'paylater';
    }

    $funding ='';
    if(!empty($options)){
        $funding = '&enable-funding='.implode(',',$options);
    }



    return view("payment.{$code}.views.pay",compact('cart','method','invoice','code','user','funding'));

}

function aiipltech_callback(){

    $cart = getCart();

    $orderID = request()->post('orderID');
    $captureData = capturePayment($orderID);
    if($captureData['status']=='COMPLETED'){
       $cart->approve(\Illuminate\Support\Facades\Auth::id());
        flashMessage(__lang('payment-completed'));
    }
    \Illuminate\Support\Facades\Log::notice($captureData);
    return response()->json($captureData);

}

function capturePayment($orderId) {
    $accessToken = generateAccessToken();
    $url = getBaseUrl() . '/v2/checkout/orders/' . $orderId . '/capture';
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    );

    return sendRequest($url, 'POST', null, $headers);
}


function aiipltech_send(){
    $invoice = getCart()->getInvoiceObject();
    $accessToken = generateAccessToken();
    $url = getBaseUrl() . '/v2/checkout/orders';
    $data = array(
        'intent' => 'CAPTURE',
        'purchase_units' => array(
            array(
                'amount' => array(
                    'currency_code' => strtoupper($invoice->currency->country->currency_code),
                    'value' =>  number_format(floatval($invoice->amount), 2, '.', '')
                )
            )
        )
    );

    $response = \Illuminate\Support\Facades\Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $accessToken
    ])->post($url,$data)->body();
    return json_decode($response);


}

function getBaseUrl(){
    $code = getCart()->getPaymentMethod()->directory;
    if(paymentOption($code,'mode')==0){
        return 'https://api-m.sandbox.paypal.com';
    }
    else{
        return 'https://api-m.paypal.com';
    }
}


// Generate an access token using client id and app secret
function generateAccessToken() {
    $code = getCode();
    $clientId = trim(paymentOption($code,'client_id'));
    $appSecret = trim(paymentOption($code,'secret'));
    $auth = base64_encode($clientId . ':' . $appSecret);
    $url = getBaseUrl() . '/v1/oauth2/token';
    $data = 'grant_type=client_credentials';

    $headers = array(
        'Authorization: Basic ' . $auth
    );

    $response = sendRequest($url, 'POST', $data, $headers);
    return $response['access_token'];

}

// Send an HTTP request
function sendRequest($url, $method, $data, $headers) {

    $response = Http::withHeaders([

    ])->post($url, [
        'grant_type' => 'client_credentials',
    ]);


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $responseData = json_decode($response, true);

    curl_close($ch);

    return $responseData;
}

function getCode(){
    return getCart()->getPaymentMethod()->directory;
}
