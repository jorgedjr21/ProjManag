<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 02/01/16
 * Time: 09:48
 */

namespace ProjManag\Transformers;

use ProjManag\Entities\Client;
use League\Fractal\TransformerAbstract;

class ProjectClientTransformer extends TransformerAbstract
{
    public function transform(Client $client){
        return [
            'client_id'=>$client->id,
            'name'=>$client->name,
            'responsible'=>$client->responsible,
            'email'=>$client->email,
            'phone'=>$client->phone,
            'address'=>$client->address,
            'obs'=>$client->obs,
            'created_at'=>$client->created_at,
            'updated_at'=>$client->updated_at,
        ];
    }

}