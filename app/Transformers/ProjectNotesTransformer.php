<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 02/01/16
 * Time: 09:48
 */

namespace ProjManag\Transformers;

use ProjManag\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNotesTransformer extends TransformerAbstract
{
    public function transform(ProjectNote $note){
        return [
            'note_id'=>$note->id,
            'title'=>$note->title,
            'note'=>$note->note,
        ];
    }

}