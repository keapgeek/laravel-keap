<?php

namespace Azzarip\Keap\Facades;

use Azzarip\Keap\Mock\FakeFacade;
use Azzarip\Keap\ServiceFactory;
use Illuminate\Support\Facades\Facade;

class Keap extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ServiceFactory::class;
    }

    public static function fake()
    {
        $fake = new MockFactory();

        static::swap($fake);
    }
}
