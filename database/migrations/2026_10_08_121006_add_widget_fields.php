<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWidgetFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->integer('repeat')->nullable();
        });

        \App\Widget::insert(
            [
                [
                    'name'=>'slideshow',
                    'code'=>'slideshow',
                    'repeat'=>10
                ],
                [
                    'name'=>'text-and-button',
                    'code'=>'textbtn',
                    'repeat'=>0
                ],
                [
                    'name'=>'featured-courses',
                    'code'=>'courses',
                    'repeat'=>10
                ],
                [
                    'name'=>'plain-text',
                    'code'=>'text',
                    'repeat'=>0
                ],
                [
                    'name'=>'blog',
                    'code'=>'blog',
                    'repeat'=>0
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('widgets', function (Blueprint $table) {
            //
        });
    }
}
