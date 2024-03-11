<?php

namespace App\Http\Controllers\Site;

use App\Certificate;
use App\Course;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Student\StudentController;
use App\Invoice;
use App\Lib\HelperTrait;
use App\PaymentMethod;
use App\Student;
use App\V2\Model\PaymentMethodTable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use HelperTrait;
    public function index(Request $request){

      $cart = getCart();

      if ($request->isMethod('post') && !empty($request->code)){
            flashMessage($cart->applyDiscount($request->code));
      }

        $currency = currentCurrency()->id;

        $paymentMethodTable = new PaymentMethodTable();
        $paymentMethods = $paymentMethodTable->getMethodsForCurrency($currency);
        $currencies = Currency::get();

        return tview('site.cart.index',compact('cart','paymentMethods','currencies'));
    }

    public function currency(Request $request, Currency $currency){
        $request->session()->put('currency',$currency->id);
        return back();
    }

    public function save(Request $request){
        $code = $request->code;
        $msg = getCart()->applyDiscount($code);
        flashMessage($msg);
        return back();
    }

    public function add(Request $request,Course $course){
        if (!canEnroll($course->id)){
            return back();
        }
        getCart()->addSession($course->id);
        return redirect()->route('cart');
    }

    public function addCertificate(Certificate $certificate){
            if(!(new StudentController())->canAccessCertificate($certificate->id)){
                return back();
            }

            getCart('c')->addCertificate($certificate->id);
        return redirect()->route('cart');

    }

    public function remove(Request $request,Course $course){
        getCart()->removeSession($course->id);
        flashMessage(__lang('course-removed'));
        return back();
    }

    public function removeCertificate(Certificate $certificate){
        getCart()->removeCertificate($certificate->id);
        flashMessage(__lang('certificate-removed'));
        return back();
    }

    public function removeCoupon(){
        getCart()->removeDiscount();
        return back();
    }

    public function process(Request $request){

        $cart = getCart();
        if ($cart->requiresPayment()){
            $this->validate($request,[
                'payment_method'=>'required'
            ]);
        }
        $method = $request->payment_method;

        $cart->setPaymentMethod($method);
        return redirect()->route('cart.checkout');
    }

    public function checkout(Request $request){
        $cart = getCart();
        $id = Auth::id();
        if (!$cart->requiresPayment()){
            $total = $cart->approve($id);
            flashMessage(__lang("you-enrolled",['total'=>$total]));
            return redirect()->route('student.student.mysessions');
        }

        if(!$cart->hasItems() || !$cart->getPaymentMethod())
        {
            return redirect()->route('cart');
        }

        //validate the currency of the payment method
        $currency = currentCurrency();
        $method = $cart->getPaymentMethod();
        if($method->is_global == 0 && $method->currencies()->where('id',$currency->id)->count()==0){
            return redirect()->route('cart');
        }

        $code = $method->directory;

        if(!$cart->hasInvoice()){
            //create invoice
            $invoice = Invoice::create([
                'user_id'=>$id,
                'currency_id'=>currentCurrency()->id,
                'amount'=>priceRaw($cart->getCurrentTotal()),
                'cart' => serialize($cart),
                'paid'=> 0,
                'payment_method_id'=>$method->id
            ]);
            $cart->setInvoice($invoice->id);
        }
        else{
            $invoice = Invoice::find($cart->getInvoice());
            $invoice->amount = priceRaw($cart->getCurrentTotal());
            $invoice->payment_method_id = $method->id;
            $invoice->cart = serialize($cart);
            $invoice->currency_id = currentCurrency()->id;
            $invoice->save();
        }

        //include function file
        if(!$this->setFunctions()){
            flashMessage(__lang('invalid-gateway'));
            return redirect()->route('cart');
        }

        if (!function_exists('aiipltech_pay')){
            flashMessage(__lang('invalid-gateway'));
            return redirect()->route('cart');
        }

        return aiipltech_pay();

    }

    public function callback(Request $request,$code){
        $this->setFunctions($code);
        if (!function_exists('aiipltech_callback')){
            flashMessage(__lang('invalid-gateway'));
            return redirect()->route('cart');
        }
        return aiipltech_callback();
    }

    public function ipn(Request $request,$code){
        $this->setFunctions($code);
        if (!function_exists('aiipltech_ipn')){
            flashMessage(__lang('invalid-gateway'));
            return redirect()->route('cart');
        }
        return aiipltech_ipn();
    }

    public function method(Request $request,$code,$function){
        $this->setFunctions($code);
        if (!function_exists($function)){
            flashMessage(__lang('invalid-gateway'));
            return redirect()->route('cart');
        }

        return $function();

    }

    public function complete(Request $request){
        $cart = getCart();
        $cart->clear();
        return tview('site.cart.complete');
    }




    private function setFunctions($code=null){
        if (!$code){
            $cart = getCart();
            $code= $cart->getPaymentMethod()->directory;
        }

        $file = 'gateways/payment/'.$code.'/functions.php';
        if (file_exists($file)){
            require_once($file);
            return true;
        }
        else{
            return false;
        }
    }


    public function mobileClose(){
        exit('close');
    }

    public function mobileLoad(Request $request){
        $this->validate($request,[
            'token'=>'required',
            'invoice'=>'required'
        ]);

        $token = $request->token;
        $invoiceId = $request->invoice;

        $time = Carbon::now()->toDateTimeString();
        $student = Student::where('api_token',trim($token))->where('token_expires','>',$time)->first();
        if(!$student){
            exit('Invalid Token');
        }

        Auth::login($student->user);

        $invoice= Invoice::find($invoiceId);
        if(!$invoice || ($student->user->id != $invoice->user_id)){
            exit('Invalid invoice');
        }

        $cart =  unserialize($invoice->cart);
        $cart->setInvoice($invoiceId);
        $cart->store();

        session(['client' => 'mobile']);
        return redirect()->route('cart.checkout');
    }





}
