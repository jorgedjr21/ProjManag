<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 23/12/15
 * Time: 04:12
 */

namespace ProjManag\Services;



use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Mockery\CountValidator\Exception;
use Prettus\Validator\Exceptions\ValidatorException;
use ProjManag\Repositories\ProjectRepository;
use ProjManag\Validators\ProjectFileValidator;
use ProjManag\Validators\ProjectValidator;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProjectService
{

    /**
     * @var ProjectValidator
     */
    protected $repository;
    /**
     * @var ProjectValidator
     */
    protected $validator;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;
    /**
     * @var ProjectFileValidator
     */
    private $projectFileValidator;

    public function __construct(ProjectRepository $repository,ProjectValidator $validator, Filesystem $filesystem,Storage $storage, ProjectFileValidator $projectFileValidator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
        $this->projectFileValidator = $projectFileValidator;
    }


    /**
     * Create new Project
     * @param array $data
     * @return array|mixed
     */

    public function create(array $data){

        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        }catch(ValidatorException $e){
                return [
                    'error'=>true,
                    'message'=>$e->getMessageBag()
                ];
        }
    }

    public function createFile(UploadedFile $file,array $data){
        try {
            $this->projectFileValidator->with($data)->passesOrFail();

            $extension = $file->getClientOriginalExtension();
            $data['extension'] = $extension;
            $project = $this->repository->skipPresenter()->find($data['project_id']);
            $projectFile = $project->files()->create($data);
            $this->storage->put($projectFile->id . '.' . $extension, $this->filesystem->get($file));
            return ['success'=>true,'message'=>'Arquivo enviado com sucesso!'];
        }catch(ValidatorException $e){
            return ['error'=>true,'message'=>$e->getMessageBag()];
        }
    }

    public function showFiles($projectId){
        return $this->repository->skipPresenter()->with(['files'])->find($projectId);
    }

    public function deleteFile($projectId,$fileId){
        $project = $this->repository->skipPresenter()->find($projectId);
        $file = $project->files()->where(['project_id'=>$projectId,'id'=>$fileId])->first();
        $this->storage->delete($file->id.'.'.$file->extension);
        $file->delete();
        return ['success'=>true,'message'=>'Arquivo excluido com sucesso'];
    }

    /**
     * Find a existent project
     * @param $id
     */
    public function find($id){
        try{
            return $this->repository->with(['owner','client','members','notes','tasks'])->find($id);
        }catch(ModelNotFoundException $e){
            return ['error'=>true,'message'=>$e->getMessage()];
        }
    }

    /**
     * Update a Project
     * @param array $data
     * @param $id
     * @return array|mixed
     */

    public function update(array $data,$id){

        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data,$id);
        }catch(ValidatorException $e){
            return [
                'error'=>true,
                'message'=>$e->getMessageBag()
            ];
        }
    }


    public function destroy($id){
        try{
            $this->repository->delete($id);
            return ['success'=>true, 'message'=>'Projeto deletado com sucesso!'];
        }catch(ModelNotFoundException $e){
            return ['error'=>true,'message'=>$e->getMessage()];
        }catch(QueryException $e){
            return ['error'=>true,'message'=>$e->getMessage()];
        }
    }

    public function getProjectMembers($projectId){
        try{
            return $this->repository->with(['members'])->find($projectId);
        }catch(ModelNotFoundException $e){
            return ['error'=>true,'message'=>$e->getMessage()];
        }
    }

    public function addMember($memberId,$projectId){
        try{
            ProjectMember::create(['project_id'=>$projectId,'member_id'=>$memberId]);
            return ['success'=>true,'message'=>'Membro adicionado com sucesso!'];
        }catch(QueryException $e){
            return ['error'=>true,'message'=>$e->getMessage()];
        }
    }

    public function removeMember($projectId,$memberId){
        try{
            ProjectMember::where(['project_id'=>$projectId,'member_id'=>$memberId])->delete();
            return ['success'=>true,'message'=>'Membro exluido com sucesso'];
        }catch(QueryException $e){
            return ['error'=>true,'message'=>$e->getMessage()];
        }
    }

}