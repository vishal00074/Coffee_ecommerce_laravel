<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable=['order_id','user_id','product_id','size_id','quantity','shipping','pay_type','order_status','payment_status','total'];
}
