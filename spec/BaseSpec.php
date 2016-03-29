<?php

namespace spec\App;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

/**
 * Class BaseSpec
 *
 * @package spec\App\Console\Commands
 */
class BaseSpec extends LaravelObjectBehavior
{
    use DatabaseTransactions;
}
