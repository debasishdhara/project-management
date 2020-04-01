<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sort_name',
        'title',
        'phone_code'
    ];
    public function state(){
        return $this->hasMany(State::class,'country_id','id');
    }
}
