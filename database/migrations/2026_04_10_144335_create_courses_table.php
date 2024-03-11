<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->boolean('enabled')->default(0);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamp('enrollment_closes')->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('payment_required');
            $table->float('fee')->nullable();
            $table->text('description')->nullable();
            $table->text('venue')->nullable();
            $table->char('type');
            $table->string('picture')->nullable();
            $table->boolean('enable_discussion')->default(1);
            $table->boolean('enable_chat')->default(1);
            $table->boolean('enforce_order')->default(1);
            $table->string('effort')->nullable();
            $table->string('length')->nullable();
            $table->text('short_description')->nullable();
            $table->text('introduction')->nullable();
            $table->boolean('enable_forum')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
