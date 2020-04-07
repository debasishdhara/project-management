<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'country_id',
        'state_status' 
    ];

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function city(){
        return $this->hasMany(City::class,'id','city_id');
    }
    
}
