<?php

namespace App\Http\Controllers;

use App\Entities\Project;
use App\Library\ApiResponseData;
use App\Library\ProjectCreator;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * ProjectController constructor.
     * @param ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'projects' => $this->repository->with(Project::$relationDeclare)->all()
        ]);
    }

    public function myProjects() {
        return response()->json([
            'projects' => $this->repository->with(Project::$relationDeclare)
                ->findByField('owner_id', \Auth::user()->id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('name', 'description', 'owner_id');
        $owner = null;
        if (!isset($data['owner_id']) || $data['owner_id'] == 0) {
            $owner = Auth::user();
        } else {
            $owner = app(UserRepositoryEloquent::class)->find($data['owner_id']);
        }

        $projectCreator = new ProjectCreator($data, $owner, $this->repository);
        $result = $projectCreator->create();
        return response()->json($result->getData(), $result->getHttpCode());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'projects' => $this->repository->with(Project::$relationDeclare)->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'description']);
        $result = new ApiResponseData();
        /** @var Project $project */
        $project = $this->repository->find($id);
        if (null == $project) {
            $result->setData('error', true);
            $result->setData('message', "Project was not found with id: {$id}");
            $result->setHttpCode(404);
        } else {
            try {
                $this->repository->update($data, $id);
                $result->setData('project', Project::with(Project::$relationDeclare)->find($project->id)->toArray());
            } catch (\Exception $e) {
                var_dump($e);
                $result->setData('error', true);
                $result->setData('message', $e->getMessage());
            }
        }

        return response($result->getData(), $result->getHttpCode());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->repository->delete($id)) {
            return response("Deleted!");
        } else {
            return response("Something went wrong!", 500);
        }
    }
}
