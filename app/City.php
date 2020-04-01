<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'state_id'
    ];

    public function state(){
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function subcity(){
        return $this->hasMany(SubCity::class,'city_id','id');
    }
}
