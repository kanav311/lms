<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultAdminRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $adminRole = new \App\AdminRole();
        $adminRole->id = 1;
        $adminRole->name = 'Super Administrator';
        $adminRole->save();

        $adminRole = new \App\AdminRole();
        $adminRole->id = 2;
        $adminRole->name = 'Administrator';
        $adminRole->save();

        //create seeder for super administrator
        $permissions = \App\Permission::get();

        $adminRole = \App\AdminRole::find(1);
        $permissionList = [];
        foreach($permissions as $permission){
            $permissionList[] = $permission->id;
        }

        $adminRole->permissions()->sync($permissionList);


        //create seeder for administrator
        $permissions = \App\Permission::where('permission_group_id','!=',9)->get();

        $adminRole = \App\AdminRole::find(2);
        $permissionList = [];
        foreach($permissions as $permission){
            $permissionList[] = $permission->id;
        }

        $adminRole->permissions()->sync($permissionList);
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
