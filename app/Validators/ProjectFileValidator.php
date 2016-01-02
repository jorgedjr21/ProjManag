<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 23/12/15
 * Time: 04:25
 */

namespace ProjManag\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        'project_id'    =>  'required|integer',
        'file'          => 'required',
        'name'          =>  'required',
        'description'   =>  'required'
    ];
}