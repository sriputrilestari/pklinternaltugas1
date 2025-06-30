<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $fillable = ['user_id','order_code','total_price','status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relasi many to many dengan product
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty','price')
        ->withTimestamps();
    }
}
