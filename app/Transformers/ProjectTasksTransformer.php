<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 02/01/16
 * Time: 09:48
 */

namespace ProjManag\Transformers;

use ProjManag\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTasksTransformer extends TransformerAbstract
{
    public function transform(ProjectTask $task){
        return [
            'task_id'=>$task->id,
            'task'=>$task->name,
            'start_date'=>$task->start_date,
            'due_date'=>$task->due_date,
            'status'=>$task->status
        ];
    }

}