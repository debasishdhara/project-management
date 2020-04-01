<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCity extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'zip_code',
        'city_id'
    ];

    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
}
