<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectRole extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'project_id',
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'project_members', 'role_id', 'user_id');
    }
}
