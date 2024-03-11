<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_options', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('test_question_id');
            $table->foreign('test_question_id')->references('id')->on('test_questions')->onDelete('cascade');
            $table->text('option');
            $table->boolean('is_correct')->default(0);
        });

        Schema::create('student_test_test_option', function (Blueprint $table) {
            $table->unsignedBigInteger('student_test_id');
            $table->foreign('student_test_id')->references('id')->on('student_tests')->onDelete('cascade');
            $table->unsignedBigInteger('test_option_id');
            $table->foreign('test_option_id')->references('id')->on('test_options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_options');
        Schema::dropIfExists('student_test_test_option');
    }
}
