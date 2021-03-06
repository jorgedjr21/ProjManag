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
use ProjManag\Repositories\ProjectRepository;
use ProjManag\Repositories\ProjectTaskRepository;
use ProjManag\Validators\ClientValidator;
use ProjManag\Validators\ProjectTaskValidator;
use ProjManag\Validators\ProjectValidator;

class ProjectTaskService
{

    /**
     * @var ProjectTaskRepository
     */
    protected $repository;
    /**
     * @var ProjectTaskValidator
     */
    protected $validator;

    public function __construct(ProjectTaskRepository $repository,ProjectTaskValidator $validator)
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
            $this->repository->create($data);
            return ['success'=>true,'message'=>'Tarefa inserida com sucesso!'];
        }catch(ValidatorException $e){
                return [
                    'error'=>true,
                    'message'=>$e->getMessageBag()
                ];
        }catch(QueryException $e){
            return [
                'error'=>true,
                'message'=>$e->getMessage()
            ];
        }
    }


    /**
     * Find a existent project task
     * @param $id
     */
    public function findWhere($id,$taskId){
        try{
            return $this->repository->findWhere(['project_id'=>$id,'id'=>$taskId]);
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
            $this->repository->update($data,$id);
            return ['success'=>true,'message'=>'Tarefa atualizada com sucesso!'];
        }catch(ValidatorException $e){
            return [
                'error'=>true,
                'message'=>$e->getMessageBag()
            ];
        }catch(QueryException $e){
            return [
                'error'=>true,
                'message'=>$e->getMessage()
            ];
        }
    }


    public function destroy($id){
        try{
            $this->repository->delete($id);
            return ['success'=>true, 'message'=>'Tarefa deletada com sucesso!'];
        }catch(ModelNotFoundException $e){
            return ['error'=>true,'message'=>$e->getMessage()];
        }catch(QueryException $e){
            return ['error'=>true,'message'=>$e->getMessage()];
        }
    }

}