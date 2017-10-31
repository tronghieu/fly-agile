<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'owner_id' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];
}
