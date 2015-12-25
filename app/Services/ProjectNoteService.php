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

use Prettus\Validator\Exceptions\ValidatorException;
use ProjManag\Repositories\ClientRepository;
use ProjManag\Repositories\ProjectNoteRepository;
use ProjManag\Validators\ProjectNoteValidator;

class ProjectNoteService
{

    /**
     * @var ClientRepository
     */
    protected $repository;
    /**
     * @var ClientValidator
     */
    protected $validator;

    public function __construct(ProjectNoteRepository $repository,ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
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


    /**
     * Show an expecific id
     * @param $id
     * @param $noteId
     * @return array
     */
    public function findWhere($id,$noteId){
        try{
            return $this->repository->findWhere(['project_id'=>$id,'id'=>$noteId]);
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
            return ['success'=>true, 'message'=>'Nota excluida com sucesso!'];
        }catch(ModelNotFoundException $e){
            return ['error'=>true,'message'=>$e->getMessage()];
        }catch(QueryException $e){
            return ['error'=>true,'message'=>$e->getMessage()];
        }
    }

}