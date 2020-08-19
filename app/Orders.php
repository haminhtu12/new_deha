<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = "order";
    public  function order_detail(){
        return $this->hasMany('App\Order_details','orders_id');
    }
    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

}
