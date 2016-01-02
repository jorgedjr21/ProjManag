<?php

namespace ProjManag\Http\Controllers;

use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use ProjManag\Repositories\ProjectRepository;
use ProjManag\Services\ProjectService;

class ProjectController extends Controller
{

    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service){

        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return $this->repository->with(['client','members','notes','tasks'])->findWhere(['owner_id'=>Authorizer::getResourceOwnerId()]);
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
    public function show($id)
    {
        if($this->checkProjectPermissions($id) == false){
            return ['error'=>true,'message'=>'Access forbidden'];
        }
        return $this->service->find($id);
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
        if($this->checkProjectPermissions($id) == false){
            return ['error'=>true,'message'=>'Access forbidden'];
        }
        return $this->service->update($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if($this->checkProjectOwner($id) == false){
            return ['error'=>true,'message'=>'Access forbidden'];
        }
        return $this->service->destroy($id);
    }

    public function members($id){
        if($this->checkProjectPermissions($id) == false){
            return ['error'=>true,'message'=>'Access forbidden'];
        }
        return $this->service->getProjectMembers($id);
    }

    public function addMember(Request $request,$id){
        if($this->checkProjectOwner($id) == false){
            return ['error'=>true,'message'=>'Access forbidden'];
        }
        return $this->service->addMember($request->member_id,$id);
    }

    public function removeMember($id,$memberId){
        if($this->checkProjectOwner($id) == false){
            return ['error'=>true,'message'=>'Access forbidden'];
        }
        return $this->service->removeMember($id,$memberId);
    }

    private function checkProjectOwner($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

    private function checkProjectMember($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->repository->isMember($projectId, $userId);
    }

    private function checkProjectPermissions($projectId)
    {
        if($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)) {
            return true;
        }
        return false;
    }
}
