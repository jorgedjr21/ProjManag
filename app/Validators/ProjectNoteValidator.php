<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 23/12/15
 * Time: 04:25
 */

namespace ProjManag\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [
        'project_id'    =>  'required|integer',
        'title'         =>  'required',
        'note'          =>  'required'
    ];
}