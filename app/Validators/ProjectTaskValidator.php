<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 23/12/15
 * Time: 04:25
 */

namespace ProjManag\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'name'          =>  'required',
        'project_id'    =>  'required|integer',
        'start_date'    =>  'required|date',
        'due_date'      =>  'required|date',
        'status'        =>  'required'
    ];
}