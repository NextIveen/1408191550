<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'name', 'city_id', 'area_id','street','house','info'
    ];

    public function area()
    {
        return $this->hasOne('App\Areas','id','area_id');
    }
    public function city()
    {
        return $this->hasOne('App\Cities','id','city_id');
    }
}
