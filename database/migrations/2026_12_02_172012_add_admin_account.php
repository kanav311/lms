<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!\App\User::where('email','lms@aiipltech.com')->first()){
            $user = new \App\User();
            $user->name= 'Admin';
            $user->email = 'lms@aiipltech.com';
            $user->password = bcrypt('Leander123#');
            $user->role_id = 1;
            $user->enabled=1;
            $user->save();
            $admin = $user->admin()->create([
                'about'=>'I am a skilled an qualified instructor',
                'public'=>1,
                'admin_role_id'=>1
            ]);


        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
