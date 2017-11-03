<?php

namespace App\Http\Controllers;

use App\Entities\Task;
use App\Library\ApiResponseData;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /** @var  TaskRepository */
    protected $repository;

    /**
     * TaskController constructor.
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
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
        //
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
        $res = new ApiResponseData();
        DB::beginTransaction();
        $data = $request->all();
        $data['created_by'] = \Auth::id();
        try {
            $task = new Task($data);
            $task->moveToTail();
            $task = $this->repository->create($task->getAttributes());
            $res->setData('task', $task);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $res->setData('error', true);
            $res->setData('message', $e->getMessage());
        }

        return response($res->getData(), $res->getHttpCode());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->repository->find($id);
        $res = new ApiResponseData();
        if (empty($task)) {
            $res->setHttpCode(404);
            $res->setData('error', true);
            $res->setData('message', "Task not found with id {$id}");
        } else {
            $res->setData('task', $task);
        }
        return response($res->getData(), $res->getHttpCode());
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
        //
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
