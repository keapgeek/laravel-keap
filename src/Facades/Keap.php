<?php

namespace Azzarip\Keap\Facades;

use Azzarip\Keap\Mock\FakeFacade;
use Azzarip\Keap\Services;
use Illuminate\Support\Facades\Facade;

class Keap extends Facade
{
    public static function token()
    {
        return new Services\Token();
    }

    public static function contact()
    {
        return new Services\Contact();
    }

    public static function campaign()
    {
        return new Services\Campaign();
    }

    public static function fake()
    {
        $fake = new FakeFacade();

        static::swap($fake);
    }
}
