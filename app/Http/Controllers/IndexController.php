<?php

namespace App\Http\Controllers;

use App\Lib\DemoBuilder;
use App\Permission;
use App\Setting;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpQuery\PhpQuery;

class IndexController extends Controller
{

    public function migrate(){
        if(saas()){
            Artisan::call('migrate', array('--path' => 'database/migrations', '--force' => true));
            return response()->json([
                'status'=>true
            ]);
        }
        else{
            abort(401);
        }

    }

    public function updateVideo(Video $video){
        $video->ready = 1;
        $video->save();
        echo "Video updated";
    }

    public function setup(Request $request){
        if (SETUP_COMPLETE==1){
            abort(401);
        }
        $validator = Validator::make($request->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'general_site_name'=>'required',
            'general_admin_email'=>'required|email',
            'general_tel'=>'required',
            'country_id'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'messages'=>$validator->getMessageBag()
            ]);
        }

        //change admin user details
        $user = User::where('role_id',1)->first();
        if($user){
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->save();
        }

        //update site info
        $this->updateSetting('general_homepage_title',$request->general_site_name);
        $this->updateSetting('general_site_name',$request->general_site_name);
        $this->updateSetting('general_admin_email',$request->general_admin_email);
        $this->updateSetting('general_tel',$request->general_tel);
        $this->updateSetting('country_id',$request->country_id);

        return response()->json([
            'status'=>true
        ]);


    }

    private function updateSetting($key,$value){
        $setting = Setting::where('key',$key)->first();
        if ($setting){
            $setting->value = $value;
            $setting->save();
        }
    }

    public function test(){
/*        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
        $videoId = 22;
        $video = Video::find($videoId);

        $path = 'uservideo/'.$video->id.'/'.$video->file_name;

        if($video->location=='r'){
            $url = Storage::cloud()->temporaryUrl($path,now()->addHours(12));
            return response()->stream(function () use ($url,$video) {
                readfile($url);
            },200,['Content-Type'=>$video->mime_type]);
        }
 */

    }

}
