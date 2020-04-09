<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'licence_name',
        'licence_key',
        'licence_description',
        'licence_discount',
        'licence_amount',
        'licence_tax',
        'licence_taxableamount',
        'licence_net_amount',
        'licence_validity',
        'licence_from',
        'licence_to',
        'licence_user_limit',
        'licence_mac',
        'licence_status'
    ];


    /**
     * The permissions that belong to the role.
     */
    public function company()
    {
        return $this->belongsToMany(Company::class,'licence_company');
    }
}
