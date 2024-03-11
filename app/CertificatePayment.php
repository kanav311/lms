<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificatePayment extends Model
{
    use HasFactory;
    protected $fillable =['user_id','certificate_id'];
}
