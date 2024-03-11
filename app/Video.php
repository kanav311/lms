<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable =['name','description','admin_id','length','ready','file_name','file_size','location','mime_type'];


}
