<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Prettus\Validator\LaravelValidator;

class Request extends FormRequest
{

    protected $class_validator;

    public function getValidator(){
        return $this->class_validator;
    }

    public function __construct(LaravelValidator $validator)
    {
        $this->class_validator = $validator;
        return parent::__construct();
    }

    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return $this->class_validator->getAttributes();
    }

    public function rules()
    {
        return $this->class_validator->getRules(LaravelValidator::RULE_CREATE);
    }

}
