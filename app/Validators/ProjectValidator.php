<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 23/12/15
 * Time: 04:25
 */

namespace ProjManag\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'owner_id'      =>  'required|integer',
        'client_id'     =>  'required|integer',
        'name'          =>  'required',
        'progress'      =>  'required',
        'status'        =>  'required',
        'due_date'      =>  'required'
    ];
}