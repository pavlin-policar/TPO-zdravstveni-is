<?php

namespace spec\App\Console\Commands;

use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

/**
 * Class InspireSpec
 *
 * An example phpspec test.
 * Generated with vendor/bin/phpspec describe App/Console/Commands/Inspire
 *
 * @package spec\App\Console\Commands
 */
class InspireSpec extends LaravelObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('App\Console\Commands\Inspire');
    }
}
