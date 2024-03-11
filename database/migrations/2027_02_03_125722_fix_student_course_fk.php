<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixStudentCourseFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_course_logs', function (Blueprint $table) {


            $foreignKeys = $this->listTableForeignKeys($table->getTable());

            if(in_array('student_course_logs_lecture_id_foreign', $foreignKeys)) $table->dropForeign('student_course_logs_lecture_id_foreign');


            try{
            //    $table->dropForeign('student_course_logs_lecture_id_foreign');
            }
            catch(\Illuminate\Database\QueryException $exception){

            }
            //loop all student logs and remove invalid lecture data
            foreach( \App\StudentCourseLog::all() as $courseLog){
                if(!\App\Lecture::find($courseLog->lecture_id)){
                    $courseLog->delete();
                }
            }

            $table->foreign('lecture_id')->references('id')->on('lectures')->onDelete('cascade');
        });
    }

    public function listTableForeignKeys($table)
    {
        $conn = Schema::getConnection()->getDoctrineSchemaManager();

        return array_map(function($key) {
            return $key->getName();
        }, $conn->listTableForeignKeys($table));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_course_logs', function (Blueprint $table) {
            //
        });
    }
}
