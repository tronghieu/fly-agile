<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class LabelValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'project_id' => 'required',
            'name' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];
}
