<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'permission_name',
        'permission_status'
    ];

    /**
     * The permissions that belong to the role.
     */
    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
}
