<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\IssueTypeRepository;
use App\Entities\IssueType;
use App\Validators\IssueTypeValidator;

/**
 * Class IssueTypeRepositoryEloquent
 * @package namespace App\Repositories;
 */
class IssueTypeRepositoryEloquent extends BaseRepository implements IssueTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return IssueType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return IssueTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
