<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $fillable = ['name','slug'];

    //membuat relasi one to many ke model product
    public function product()
    {
        return $this->hasMany(product::class);
    }

    //mengganti kunci dari "id" ke "slug"
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
