<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProjectRoleRepository;
use App\Entities\ProjectRole;
use App\Validators\ProjectRoleValidator;

/**
 * Class ProjectRoleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProjectRoleRepositoryEloquent extends BaseRepository implements ProjectRoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectRole::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
