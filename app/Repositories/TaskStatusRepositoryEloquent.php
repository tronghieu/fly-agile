<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TaskStatusRepository;
use App\Entities\TaskStatus;
use App\Validators\TaskStatusValidator;

/**
 * Class TaskStatusRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TaskStatusRepositoryEloquent extends BaseRepository implements TaskStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TaskStatus::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TaskStatusValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
