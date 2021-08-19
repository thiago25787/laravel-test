<?php

namespace App\Http\Requests;

use App\Validators\AccountValidator;
use Prettus\Validator\LaravelValidator;

class AccountRequest extends Request
{
    public function __construct(AccountValidator $validator)
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
