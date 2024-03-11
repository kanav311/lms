<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTest extends Model
{
    protected $fillable = ['student_id','test_id','score'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function test(){
        return $this->belongsTo(Test::class);
    }

    public function testOptions(){
        return $this->belongsToMany(TestOption::class);
    }

}
