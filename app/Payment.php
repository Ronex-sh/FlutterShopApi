<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=[
        'amont','user_id','order_id',
        'paid_on','patment_reference'
    ];

    public function customer(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
