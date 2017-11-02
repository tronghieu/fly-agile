<?php

namespace App\Entities;

use App\Library\CoordinatesAllocator;
use App\Library\SmartOrdering;
use App\Repositories\IssueTypeRepository;
use App\Repositories\IssueTypeRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class IssueType extends Model implements Transformable
{
    use TransformableTrait, SmartOrdering;

    protected $fillable = ['name', 'color'];

    public function createRepository(): IssueTypeRepository
    {
        return app(IssueTypeRepositoryEloquent::class);
    }

    public function orderIdColumn() {
        return 'ordering_id';
    }
}
