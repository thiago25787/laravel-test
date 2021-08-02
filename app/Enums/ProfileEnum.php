<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ADMIN()
 * @method static static CUSTOMER()
 */
final class ProfileEnum extends Enum
{
    const ADMIN = "admin";
    const CUSTOMER = "customer";
}
