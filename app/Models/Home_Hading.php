<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home_Hading extends Model
{
    use HasFactory;
    
    protected $fillable=['heading','product_id'];
}
