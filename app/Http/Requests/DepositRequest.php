<?php

namespace App\Http\Requests;

use App\Validators\DepositValidator;
use Prettus\Validator\LaravelValidator;

class DepositRequest extends Request
{
    public function __construct(DepositValidator $validator)
    {
        return parent::__construct($validator);
    }

    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return $this->getValidator()->getRules(LaravelValidator::RULE_CREATE);
    }
}
