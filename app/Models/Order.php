<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $fillable = ['user_id','total__price','order_code','status'];
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
