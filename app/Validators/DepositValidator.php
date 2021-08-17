<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class DepositValidator.
 *
 * @package namespace App\Validators;
 */
class DepositValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'amount' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ],
        ValidatorInterface::RULE_UPDATE => [

        ],
    ];
}
