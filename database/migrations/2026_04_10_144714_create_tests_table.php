<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->boolean('enabled')->default(0);
            $table->integer('minutes')->nullable();
            $table->boolean('allow_multiple')->default(0);
            $table->float('passmark')->nullable();
            $table->boolean('private')->default(0);
            $table->boolean('show_result')->default(1);
        });

        Schema::table('lessons', function (Blueprint $table) {

            $table->foreign('test_id')->references('id')->on('tests');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
