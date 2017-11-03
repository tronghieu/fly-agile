<?php

namespace App\Http\Controllers;

use App\Entities\Issue;
use App\Library\ApiResponseData;
use App\Repositories\IssueRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IssueController extends Controller
{
    /**
     * @var IssueRepository
     */
    protected $repository;

    /**
     * IssueController constructor.
     * @param IssueRepository $repository
     */
    public function __construct(IssueRepository $repository)
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
    }*/

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
            $issue = new Issue($data);
            $issue->moveToTail();
            $issue = $this->repository->create($issue->getAttributes());
            $res->setData('issue', $issue);
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
        return response(
            $this->repository->find($id)
        );
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
        $res = new ApiResponseData();
        DB::beginTransaction();
        $data = $request->all();
        $data['created_by'] = \Auth::id();
        try {
            $issue = $this->repository->update($data, $id);
            $res->setData('issue', $issue);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $res->setData('error', true);
            $res->setData('message', $e->getMessage());
        }

        return response($res->getData(), $res->getHttpCode());
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
