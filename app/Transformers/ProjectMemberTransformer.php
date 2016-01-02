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

class ProjectMemberTransformer extends TransformerAbstract
{
    public function transform(User $member){
        return [
            'member_id'=>$member->id,
            'name'=>$member->name,
            'email'=>$member->email,
        ];
    }

}