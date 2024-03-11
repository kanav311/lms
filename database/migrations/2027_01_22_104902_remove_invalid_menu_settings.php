<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveInvalidMenuSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $name = $table->getTable();
            $prefix = \Illuminate\Support\Facades\DB::getTablePrefix();
            $name = $prefix.$name;

            $values = [
                'menu_show_blog','menu_show_contact','menu_show_articles','menu_show_attended'
            ];

            foreach ($values as $value) {
                \Illuminate\Support\Facades\DB::statement("DELETE FROM {$name} WHERE {$name}.key='{$value}'");
            }



        });
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
