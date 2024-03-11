<?php
namespace App\Lib;

use App\Ip;
use App\Setting;
use App\Template;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Laminas\ServiceManager\Config;
use Laminas\ServiceManager\ServiceManager;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\Db\Adapter\Adapter;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Transport\Dsn;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransportFactory;

class Helpers {

    static public function bootProviders(){

        Schema::defaultStringLength(191);
        if(!file_exists('../storage/installed')){
            return true;
        }

        try{

            if(!Schema::hasTable('settings')){
                return true;
            }
        }
        catch (\Exception $ex){
            return true;
        }


        try{
            //check for ssl
            if (setting('general_ssl')==1){
                forceSSL();

            }

            //setup filesystems
            if(setting('video_driver')=='s3' && !saas()){

                config([
                    'filesystems.cloud'=>'s3',
                    'filesystems.disks.s3.key'=>setting('video_s3_key'),
                    'filesystems.disks.s3.secret'=>setting('video_s3_secret'),
                    'filesystems.disks.s3.region'=>setting('video_s3_region'),
                    'filesystems.disks.s3.bucket'=>setting('video_s3_bucket'),
                ]);
                if(!empty(setting('video_s3_endpoint'))){
                    config([
                        'filesystems.disks.s3.endpoint'=>setting('video_s3_endpoint'),
                    ]);
                }
            }


            //setup email

            config([
                'mail.from'=>[
                    'address'=>setting('general_admin_email'),'name'=>setting('general_site_name')
                    ]
            ]);

            $protocol = setting('mail_protocol');
            if($protocol=='smtp'){
                config([
                    'mail.mailers.smtp.driver' => 'smtp',
                    'mail.mailers.smtp.host' => setting('mail_smtp_host'),
                    'mail.mailers.smtp.port' => setting('mail_smtp_port'),
                    'mail.mailers.smtp.encryption' =>'tls',
                    'mail.mailers.smtp.username' => setting('mail_smtp_username'),
                    'mail.mailers.smtp.password' => setting('mail_smtp_password')
                ]);

                $encryption = env('MAIL_ENCRYPTION','tls');
                if(is_null($encryption))
                {
                    $encryption = 'tls';
                }
                $dsn = new Dsn(
                    $encryption,setting('mail_smtp_host'),setting('mail_smtp_username'),setting('mail_smtp_password'),setting('mail_smtp_port')
                );
                $factory = new EsmtpTransportFactory;
                $transport = $factory->create($dsn);

                Mail::mailer()->setSymfonyTransport($transport);

            }

            //set language
            $language = setting('config_language');
            if($language != 'en'){
                App::setLocale($language);
            }
        }
        catch(\Exception $ex){

        }

        define('UPLOAD_PATH',config('app.upload_path'));
        define('EDITOR_IMAGES','editor_images');
        define('BLOG_FILES','blog_files');
        define('TEMPLATE_PATH','templates');
        define('PAYMENT_PATH','gateways/payment');
        define('MESSAGING_PATH','gateways/messaging');
        define('TEMP_DIR','../storage/tmp');
        define('TEMPLATE_FILES','template_files');
        define('PENDING_USER_FILES','pending_files');
        define('STUDENT_FILES','student_files');




        //define path to current template
        $currentTemplate = Template::where('enabled',1)->first();

        if($currentTemplate){

            $layout = $currentTemplate->directory.'.views.layouts.layout';

            define('TLAYOUT',$layout);

        }
        else{
            define('TLAYOUT','layouts.app');
        }


        View::composer('*', function($view) {
            if (Auth::check()) {
                $user = Auth::user();
                switch($user->role_id){
                    case 1:
                        $userLayout = 'layouts.admin';
                        break;
                    case 2:
                        $userLayout = 'layouts.student';
                        break;
                }

                $view->with('userLayout',$userLayout);
            }

        });




        Blade::directive('route', function ($arguments) {
            return "<?php echo route({$arguments}); ?>";
        });


        //impement laminas service container
        $serviceManager = new ServiceManager([
            'factories' => [
                Adapter::class => function($sm){
                    if(saas()){
                        $db = USER_DB_NAME;
                    }
                    else{
                        $db = env('DB_DATABASE');
                    }
                    $adapter = new \Laminas\Db\Adapter\Adapter([
                        'driver'   => config('app.laminas_driver'),
                        'database' => $db,
                        'username' => env('DB_USERNAME'),
                        'password' => env('DB_PASSWORD'),
                        'hostname' => env('DB_HOST'),
                        'port' => env('DB_PORT'),
                        'driver_options' => [
                            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
                        ],
                    ]);

                    return $adapter;
                },
            ],
        ]);
        $GLOBALS['serviceManager'] = $serviceManager;


        //check if user has global access
        $user= '';
        if(defined('USER_ID')){
            $user = '/'.USER_ID;
        }

        if(!defined('USER_PATH')){
            $filePath = 'usermedia'.$user;
            define('USER_PATH',$filePath);
        }



        if (!defined('DIR_MER_IMAGE')){
            define('DIR_MER_IMAGE', '');
        }




        //ensure a template is installed
        if(!Template::where('enabled',1)->first()){
            $template = Template::first();
            $template->enabled =1;
            $template->save();
        }

        Helpers::syncLanguage();

        //set baseurl
        $baseUrl = url('/');
        if($baseUrl != setting('config_baseurl') && !app()->runningInConsole())
        {
            $setting = Setting::where('key','config_baseurl')->first();
            $setting->value = $baseUrl;
            $setting->save();
        }




    }

     static public function getCountry(){
        $ip_address = Helpers::getClientIp();

         $data = ['ip'=>$ip_address];
         $validator = Validator::make($data,[
             'ip'=>'ip'
         ]);

         if($validator->fails()){

             return 'us';
         }

         if(env('APP_ENV','production')=='production'){

             $validator = Validator::make($data,[
                 'ip'=>'unique:ips'
             ]);

             if(!$validator->fails()){
                 //create ip record in db
                 $country = file_get_contents("http://ipinfo.io/$ip_address/country");

                 $country = trim(strtolower($country));

              //   notifyAdmin('country fetched',$ip_address.' . line 31: '.$country);

                 if(empty($country) || strlen($country)!=2){
                     $country = 'us';
                 }


                  Ip::create(['ip'=>$ip_address,'country'=>$country]);
                 return $country;
             }
             else{

                $ipModel = Ip::where('ip',$ip_address)->first();
                return $ipModel->country;
             }


         }
         else{

                return 'us';
         }

    }

    static public function getClientIp() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    static public function isBot(){

    $bots = array(
        'Googlebot', 'Baiduspider', 'ia_archiver',
        'R6_FeedFetcher', 'NetcraftSurveyAgent', 'Sogou web spider',
        'bingbot', 'Yahoo! Slurp', 'facebookexternalhit', 'PrintfulBot',
        'msnbot', 'Twitterbot', 'UnwindFetchor',
        'urlresolver', 'Butterfly', 'TweetmemeBot' );


    foreach($bots as $b){

        if( stripos( $_SERVER['HTTP_USER_AGENT'], $b ) !== false ) return true;

    }



    return false;

}

    static public function sendMail($to,$subject,$message){
        $mail = new \App\Lib\Mail();
        $mail->setSender(env('APP_NAME'));
        $mail->setFrom(env('APP_EMAIL'));
        $mail->setTo($to);
        $mail->setSubject($subject);
        $mail->setHtml($message);
        $mail->send();
    }

    static public function syncLanguage(){
        //sync language files
        //check if language file exists for current template
        $currentTemplate = currentTemplate();
        if(!$currentTemplate){
            return false;
        }

        $langFile= './templates/'.$currentTemplate->directory.'/lang.php';
        // $laguage = getL
        //check for installed lang file
        $language = setting('config_language');
        $tempLang = '../resources/lang/en/temp_'.$currentTemplate->directory.'.php';

        if(!file_exists($langFile)){
            return false;
        }

        //check if tempLang is installed already
        if(!file_exists($tempLang)){
            copy($langFile,$tempLang);
            return true;
        }

        //now check if there are any changes in file modified time. Copy if so
        if(filemtime($langFile) > filemtime($tempLang)){
            unlink($tempLang);
            copy($langFile,$tempLang);
            return true;
        }




    }


}
