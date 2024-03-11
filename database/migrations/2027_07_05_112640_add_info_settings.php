<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //conditionally add info settings back
        $info = \App\Setting::where('key','info_terms')->first();
        if(!$info){
             \App\Setting::insert(
                     [
                         'key'=>'info_terms',
                         'type'=>'textarea',
                         'options'=>'',
                         'class'=>'rte',
                     ]
             );
        }

        $privacy = \App\Setting::where('key','info_privacy')->first();
        if(!$privacy){
            \App\Setting::insert(
                [
                    'key'=>'info_privacy',
                    'type'=>'textarea',
                    'options'=>'',
                    'class'=>'rte',
                ]
            );
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
