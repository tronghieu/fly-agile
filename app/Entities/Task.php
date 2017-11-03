<?php

namespace App\Entities;

use App\Library\SmartOrdering;
use App\Repositories\TaskRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Task extends Model implements Transformable
{
    use TransformableTrait, SmartOrdering;

    protected $fillable = [
        'task_status_id',
        'title',
        'description',
        'estimate',
        'consumed',
        'created_by',

    ];

    /**
     * Return the ordering id column configuration for this model.
     *
     * @return string
     */
    public function orderIdColumn(): string
    {
        return 'ordering';
    }

    public function createRepository(): RepositoryInterface
    {
        return app(TaskRepositoryEloquent::class);
    }
}
