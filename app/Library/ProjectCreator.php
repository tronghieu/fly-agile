<?php
/**
 * Created by PhpStorm.
 * User: mnqf2zp
 * Date: 10/30/17
 * Time: 22:58
 */

namespace App\Library;

use App\Entities\IssueType;
use App\Entities\Project;
use App\Entities\Status;
use App\Entities\TaskStatus;
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
            $this->data['owner_id'] = $this->owner->id;

            $project = $this->repository->create($this->data);

            $this->_initProjectOwner($project);
            $this->_initProjectIssueTypes($project);
            $this->_initProjectIssueStatuses($project);
            $this->_initProjectTaskStatuses($project);

            $result->setData('project', Project::with(Project::$relationDeclare)->find($project->id)->toArray());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $result->setData('error', true);
            $result->setData('message', $e->getMessage());
            $result->setHttpCode(500);
        }

        return $result;
    }

    private function _initProjectIssueTypes(Project $project) {
        $types = config('settings.project_templates.issue_types');
        foreach ($types as $type) {
            $issueType = new IssueType($type);
            $issueType->project_id = $project->id;
            $issueType->moveToTail();
            $issueType->save();
        }
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
        if (!($this->owner instanceof User) || $this->owner->id <= 0) {
            throw new ValidatorException(new MessageBag(['owner_id' => 'Project owner is required!']));
        }
    }

    private function _initProjectIssueStatuses($project)
    {
        $statuses = config('settings.project_templates.statuses');
        for ($i = 0; $i < sizeof($statuses); ++$i) {
            $status = new Status($statuses[$i]);
            $status->project_id = $project->id;
            $status->moveToTail();
            $status->save();
        }
    }

    private function _initProjectTaskStatuses($project)
    {
        $statuses = config('settings.project_templates.task_statuses');
        for ($i = 0; $i < sizeof($statuses); ++$i) {
            $status = new TaskStatus($statuses[$i]);
            $status->project_id = $project->id;
            $status->moveToTail();
            $status->save();
        }
    }
}