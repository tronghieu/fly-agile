<?php
/**
 * Created by PhpStorm.
 * User: mnqf2zp
 * Date: 10/30/17
 * Time: 22:58
 */

namespace App\Library;

use App\Entities\Project;
use App\Repositories\ProjectRepository;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectCreator
{
    protected $data;

    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var User
     */
    protected $owner;

    /**
     * ProjectCreator constructor.
     * @param $data
     * @param ProjectRepository $repository
     */
    public function __construct($data, $owner, ProjectRepository $repository)
    {
        $this->data = $data;
        $this->owner = $owner;
        $this->repository = $repository;
    }


    public function create()
    {
        $result = new ApiResponseData();
        DB::beginTransaction();
        try {
            //validate owner
            $this->_validateOwner();

            $project = new Project($this->data);

            $project = $this->owner->projects()->save($project);

            $this->_initProjectOwner($project);
            $this->_initProjectIssueTypes($project);
            $this->_initProjectIssueStatuses($project);
            $this->_initProjectTaskStatuses($project);

            //return data
            $result->setData('project', $project);

            var_dump($result); exit;
//            DB::commit();
        } catch (ValidatorException $e) {
            var_dump($e);
            DB::rollback();
            $result->setData('error', true);
            $result->setData('message', $e->getMessage());
        }

        return $result;
    }

    private function _initProjectIssueTypes(Project $project) {
    }

    private function _initProjectOwner(Project $project) {
        $role = $project->roles()->create([
            'name' => config('settings.project_templates.first_role')
        ]);

        $this->owner->roles()->attach($role->id, [
            'is_admin' => true
        ]);
    }

    private function _validateOwner()
    {
        if (!($this->owner instanceof User)) {
            throw new ValidatorException(new MessageBag(['owner_id' => 'Project owner is required!']));
        }
    }

    private function _initProjectIssueStatuses($project)
    {
    }

    private function _initProjectTaskStatuses($project)
    {
    }
}