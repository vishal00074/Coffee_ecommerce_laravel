<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuries extends Model
{
    use HasFactory;
    
     public $table = 'user_quries';
    
    protected $fillable=['name','email','subject','message'];
}
