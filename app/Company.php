<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'company_email',
        'company_phone',
        'company_address_line_1',
        'company_address_line_2',
        'company_address_line_3',
        'company_state',
        'company_country',
        'company_pin',
        'company_fax',
        'company_gstin',
        'company_vat',
        'company_alise',
        'company_validity',
        'company_from',
        'company_to',
        'company_status'
    ];
}
