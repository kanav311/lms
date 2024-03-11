<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code');
            $table->integer('discount');
            $table->timestamp('expires_on')->nullable();
            $table->boolean('enabled')->default(0);
            $table->string('name');
            $table->char('type');
            $table->float('total');
            $table->timestamp('date_start')->nullable();
            $table->integer('uses_total')->nullable();
            $table->integer('uses_customer')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
