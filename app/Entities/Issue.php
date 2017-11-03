<?php

namespace App\Entities;

use App\Library\SmartOrdering;
use App\Repositories\IssueRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Issue extends Model implements Transformable
{
    use TransformableTrait, SmartOrdering;

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'issue_type_id',
        'status_id',
        'estimate_points',
        'consumed_points',
        'ordering',
        'is_closed',
        'is_task',
        'created_by',
        'assignee',
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
        return app(IssueRepositoryEloquent::class);
    }
}
