<?php

namespace ProjManag\Http\Controllers;

use Illuminate\Http\Request;
use ProjManag\Repositories\ProjectNoteRepository;
use ProjManag\Services\ProjectNoteService;


class ProjectNoteController extends Controller
{

    /**
     * @var ProjectNoteRepository
     */
    private $repository;
    /**
     * @var ProjectNoteService
     */
    private $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service){

        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        return $this->repository->skipPresenter()->findWhere(['project_id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$noteId)
    {
        return $this->service->findWhere($id,$noteId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param int $noteId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id,$noteId)
    {
        //
        return $this->service->update($request->all(),$noteId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $noteId
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$noteId)
    {
        //
        return $this->service->destroy($noteId);
    }
}
