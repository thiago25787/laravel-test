<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PurchaseValidator.
 *
 * @package namespace App\Validators;
 */
class PurchaseValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'amount' => 'required|numeric',
            'description' => 'required|max:255',
        ],
        ValidatorInterface::RULE_UPDATE => [

        ],
    ];
}
