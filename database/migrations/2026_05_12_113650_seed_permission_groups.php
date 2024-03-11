<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedPermissionGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\PermissionGroup::insert([
            [
                'id'=>'1',
                'name'=>'student',
                'sort_order'=>'1',
            ],
            [
                'id'=>'2',
                'name'=>'course',
                'sort_order'=>'2',
            ],
            [
                'id'=>'3',
                'name'=>'attendance',
                'sort_order'=>'3',
            ],
            [
                'id'=>'4',
                'name'=>'classes',
                'sort_order'=>'4',
            ],
            [
                'id'=>'5',
                'name'=>'revision_notes',
                'sort_order'=>'5',
            ],
            [
                'id'=>'6',
                'name'=>'blog',
                'sort_order'=>'6',
            ],
            [
                'id'=>'7',
                'name'=>'files',
                'sort_order'=>'7',
            ],
            [
                'id'=>'8',
                'name'=>'articles',
                'sort_order'=>'8',
            ],
            [
                'id'=>'9',
                'name'=>'settings',
                'sort_order'=>'9',
            ],
            [
                'id'=>'10',
                'name'=>'tests',
                'sort_order'=>'10',
            ],
            [
                'id'=>'11',
                'name'=>'discussions',
                'sort_order'=>'11',
            ],
            [
                'id'=>'12',
                'name'=>'certificates',
                'sort_order'=>'12',
            ],
            [
                'id'=>'13',
                'name'=>'downloads',
                'sort_order'=>'13',
            ],
            [
                'id'=>'14',
                'name'=>'miscellaneous',
                'sort_order'=>'14',
            ],
            [
                'id'=>'15',
                'name'=>'homework',
                'sort_order'=>'15',
            ],
            [
                'id'=>'16',
                'name'=>'reports',
                'sort_order'=>'16',
            ],
            [
                'id'=>'17',
                'name'=>'survey',
                'sort_order'=>'17',
            ]

        ]);
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
