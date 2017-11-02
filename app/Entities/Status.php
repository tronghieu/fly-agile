<?php

namespace App\Entities;

use App\Library\SmartOrdering;
use App\Repositories\StatusRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Status extends Model implements Transformable
{
    use TransformableTrait, SmartOrdering;

    protected $fillable = ['name', 'color'];

    /**
     * Return the ordering id column configuration for this model.
     *
     * @return string
     */
    public function orderIdColumn(): string
    {
        return 'ordering_id';
    }

    public function createRepository(): RepositoryInterface
    {
        return app(StatusRepositoryEloquent::class);
    }
}
