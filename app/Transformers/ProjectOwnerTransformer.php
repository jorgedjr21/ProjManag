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

class ProjectOwnerTransformer extends TransformerAbstract
{
    public function transform(User $owner){
        return [
            'owner_id'=>$owner->id,
            'name'=>$owner->name,
            'email'=>$owner->email,
        ];
    }

}