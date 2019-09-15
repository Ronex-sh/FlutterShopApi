<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'user_id','payment_id','order_date',
        'cart_id'
    ];

     public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
