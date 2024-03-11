<?php

namespace App\Http\Controllers\Site;

use App\Admin;
use App\Article;
use App\Http\Controllers\Controller;
use App\Lib\CronJobs;
use App\Lib\HelperTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use HelperTrait;
    public function index(){

        //check if installation file exists and redirect to install if not
        if(!file_exists('../storage/installed')){
           return redirect('/install');
        }

        return tview('site.home.index');
    }

    public function article($slug){

        $article = Article::where('slug',$slug)->where('enabled',1)->first();
        if(!$article){
          return  abort(404);
        }


        return tview('site.home.article',compact('article'));
    }

    public function contact(){
        $captchaUrl = captcha_src();
        return tview('site.home.contact',compact('captchaUrl'));
    }

    public function sendMail(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'message'=>'required',
            'captcha' => 'required|captcha'
        ]);

        if(!empty(setting('general_admin_email')))
        {
            $this->sendEmail(setting('general_admin_email'),__('default.contact-form-message'),$request->message,['address'=>$request->email,'name'=>$request->name]);
        }

        return back()->with('flash_message',__('default.message-sent'));

    }

    public function privacy(){
        $title= __lang('privacy-policy');
        $content = setting('info_privacy');
        return tview('site.home.info',compact('title','content'));
    }

    public function terms(){
        $title= __lang('terms-conditions');
        $content = setting('info_terms');
        return tview('site.home.info',compact('title','content'));

    }

    public function instructors(){
        $admins = Admin::where('public',1)->whereHas('user',function($query){
            $query->orderBy('name');
        })->get();


        return tview('site.home.instructors',compact('admins'));
    }

    public function instructor(Admin $admin){
        if (empty($admin->public)){
            abort(401);
        }
        return tview('site.home.instructor',compact('admin'));
    }

    public function cron(Request $request,$method)
    {
        set_time_limit(3600);
        //protect ip
        $ip = setting('general_site_ip');
        if(!empty($ip) && trim($ip) != $_SERVER['REMOTE_ADDR']){
            exit('Unauthorized access');
        }

        //process only at 12noon in the first minute
        $hour= date('G');
        $minute = date('i');
        $cHour = setting('general_reminder_hour');
        if($hour != $cHour ){
            exit('Invalid time for cron');
        }

        $jobs= new CronJobs();
        call_user_func([$jobs,$method]);
    }
}
