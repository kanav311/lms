<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeLessonPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_lessons', function (Blueprint $table) {

            $table->dropColumn('id');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->timestamp('lesson_date')->nullable();
            $table->text('lesson_venue')->nullable();
            $table->string('lesson_start')->nullable();
            $table->string('lesson_end')->nullable();
            $table->integer('sort_order')->nullable();
        });

        Schema::table('course_lessons', function (Blueprint $table) {
              $table->rename('course_lesson');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_lessons', function (Blueprint $table) {
            //
        });
    }
}
