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
use ProjManag\Validators\ClientValidator;

class ClientService
{

    /**
     * @var ClientRepository
     */
    protected $repository;
    /**
     * @var ClientValidator
     */
    protected $validator;

    public function __construct(ClientRepository $repository,ClientValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

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

    public function find($id){
        try{
            return  $this->repository->skipPresenter()->find($id);
        }catch(ModelNotFoundException $e){
            return [
                'error'=>true,
                'message'=>$e->getMessage()
            ];
        }
    }

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
            return ['success'=>true,'message'=>'Usuario excluido com sucesso!'];
        }catch(QueryException $e){
            return ['error'=>true,'message'=>$e->getMessage()];
        }catch(ModelNotFoundException $ex){
            return ['error'=>true, 'message'=>$ex->getMessage()];
        }
    }
}