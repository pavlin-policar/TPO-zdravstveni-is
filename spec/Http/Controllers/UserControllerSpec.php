<?php

namespace spec\App\Http\Controllers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserControllerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('App\Http\Controllers\UserController');
    }
}
