<?php

namespace Tests\Browser;

use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{

    /**
     * My test implementation
     */
    public function testCreateUser()
    {
        $email = 'test' . rand(1000, 9999) . '@test.com';
        $this->browse(function ($browser) use($email) {
            $browser->visit('/login');
            $browser->visit('/register');
            $browser->type('test', 'name');
            $browser->type($email, 'email');
            $browser->type('password', 'password');
            $browser->type('password', 'password_confirmation');
            $browser->press('Register');
            $browser->seePageIs('/account');
        });
    }
}
