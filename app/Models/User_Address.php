<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User_Address extends Model
{
    use HasApiTokens ,HasFactory;
    
    public $table = 'user_address';
    
    protected $fillable=['user_id','house_no','city','state','country','landmark','pincode','phone','shipping_name','shipping_email'];
}
