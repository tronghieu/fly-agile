<?php
/**
 * Created by PhpStorm.
 * User: mnqf2zp
 * Date: 10/30/17
 * Time: 22:58
 */

namespace App\Library;

use App\Entities\Project;
use App\Repositories\ProjectMemberRepositoryEloquent;
use App\Repositories\ProjectRepository;
use App\Repositories\ProjectRoleRepositoryEloquent;
use App\Validators\ProjectValidator;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectCreator
{
    protected $data;

    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * ProjectCreator constructor.
     * @param $data
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     */
    public function __construct($data, ProjectRepository $repository)
    {
        $this->data = $data;
        $this->repository = $repository;
    }


    public function create()
    {
        $result = new ApiResponseData();
        DB::beginTransaction();
        try {
            //create project record
            $project = $this->repository->create($this->data);

            $this->_initProjectOwner($project);

            $this->_initProject($project);
            //create project follow template: issue, statuses, task's statuses

            //return data
            $result->setData('project', $project);

            var_dump($result); exit;
//            DB::commit();
        } catch (ValidatorException $e) {
            DB::rollback();
            $result->setData('error', true);
            $result->setData('message', $e->getMessage());
        }

        return $result;
    }

    private function _initProject(Project $project) {
    }

    private function _initProjectOwner(Project $project) {
        $role = $project->roles()->create([
            'name' => config('settings.project_templates.first_role')
        ]);

        var_dump($role); exit;

        $projectMemberRepository = app(ProjectMemberRepositoryEloquent::class);
    }
}