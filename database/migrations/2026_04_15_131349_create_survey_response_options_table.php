<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyResponseOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_response_survey_option', function (Blueprint $table) {
            $table->unsignedBigInteger('survey_response_id');
            $table->foreign('survey_response_id')->references('id')->on('survey_responses')->onDelete('cascade');
            $table->unsignedBigInteger('survey_option_id');
            $table->foreign('survey_option_id')->references('id')->on('survey_options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_response_options');
    }
}
