<?php

namespace App\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait, Sluggable;

    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get the comments for the blog post.
     */
    public function roles()
    {
        return $this->hasMany(ProjectRole::class);
    }

    public function issueTypes()
    {
        return $this->hasMany(IssueType::class);
    }

    public function issueStatuses()
    {
        return $this->hasMany(Status::class);
    }

    public function taskStatuses() {
        return $this->hasMany(TaskStatus::class);
    }
}
