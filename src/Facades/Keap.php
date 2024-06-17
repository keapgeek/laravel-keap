<?php

namespace KeapGeek\Keap\Facades;

use Illuminate\Support\Facades\Facade;
use KeapGeek\Keap\Mock\MockFactory;
use KeapGeek\Keap\ServiceFactory;

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
