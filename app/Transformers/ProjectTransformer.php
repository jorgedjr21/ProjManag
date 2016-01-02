<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 02/01/16
 * Time: 09:48
 */

namespace ProjManag\Transformers;

use ProjManag\Entities\Project;
use League\Fractal\TransformerAbstract;
use ProjManag\Entities\ProjectNote;

class ProjectTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['members','owner','client','tasks','notes'];
    public function transform(Project $p){
        return [
            'project_id'=>$p->id,
            'project'=>$p->name,
            'description'=>$p->description,
            'progress'=>$p->progress,
            'status'=>$p->status,
            'due_date'=>$p->due_date,
            'created_at'=>$p->created_at,
            'updated_at'=>$p->updated_at,
        ];
    }

    public function includeMembers(Project $p){
        return $this->collection($p->members,new ProjectMemberTransformer());
    }

    public function includeOwner(Project $p){
        return $this->item($p->owner,new ProjectOwnerTransformer());
    }

    public function includeClient(Project $p){
        return $this->item($p->client,new ProjectClientTransformer());
    }

    public function includeTasks(Project $p){
        return $this->collection($p->tasks,new ProjectTasksTransformer());
    }

    public function includeNotes(Project $p){
        return $this->collection($p->notes,new ProjectNotesTransformer());
    }

}