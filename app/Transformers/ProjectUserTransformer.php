<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 02/01/16
 * Time: 09:48
 */

namespace ProjManag\Transformers;

use ProjManag\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectUserTransformer extends TransformerAbstract
{
    public function transform(User $user){
        return [
            'member_id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
        ];
    }

}