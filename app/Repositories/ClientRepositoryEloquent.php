<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 22/12/15
 * Time: 12:58
 */

namespace ProjManag\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use ProjManag\Entities\Client;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{

    public function model(){
        return Client::class;
    }

}