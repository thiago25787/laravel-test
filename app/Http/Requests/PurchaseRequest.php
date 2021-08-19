<?php

namespace App\Http\Requests;

use App\Validators\PurchaseValidator;
use Prettus\Validator\LaravelValidator;

class PurchaseRequest extends Request
{
    public function __construct(PurchaseValidator $validator)
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
