<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 23/12/15
 * Time: 04:25
 */

namespace ProjManag\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
    protected $rules = [
        'name'          =>  'required|max:255',
        'responsible'   =>  'required|max:255',
        'email'         =>  'required|email',
        'phone'         =>  'required',
        'address'       =>  'required'
    ];
}