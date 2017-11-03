<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class TaskValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => 'required',
            'task_status_id' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'required',
            'task_status_id' => 'required',
        ],
    ];
    
    protected $messages = [
        'required' => 'The :attribute field is required.',
    ];
}
