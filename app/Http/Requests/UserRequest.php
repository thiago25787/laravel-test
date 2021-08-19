<?php

namespace App\Http\Requests;

use App\Validators\UserValidator;
use Prettus\Validator\LaravelValidator;

class UserRequest extends Request
{
    public function __construct(UserValidator $validator)
    {
        return parent::__construct($validator);
    }

    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        $rules = $this->getValidator()->getRules(LaravelValidator::RULE_UPDATE);
        $rules["email"] .= "," . auth()->user()->id;
        return $rules;
    }
}
