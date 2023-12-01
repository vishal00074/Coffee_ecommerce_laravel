<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Happy_Customer extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','description','image'];
}
