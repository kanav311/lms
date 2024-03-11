<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \App\Setting::create(
            [
                'key'=>'video_driver',
                'type'=>'select',
                'value'=>'local',
                'options'=>'local=Local,s3=S3'
            ]
        );
        \App\Setting::create(
            [
                'key'=>'video_s3_key',
                'type'=>'text',
            ]
        );
        \App\Setting::create(
            [
                'key'=>'video_s3_secret',
                'type'=>'text',
            ]
        );
        \App\Setting::create(
            [
                'key'=>'video_s3_region',
                'type'=>'text',
            ]
        );
        \App\Setting::create(
            [
                'key'=>'video_s3_bucket',
                'type'=>'text',
            ]
        );
        \App\Setting::create(
            [
                'key'=>'video_s3_endpoint',
                'type'=>'text',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
