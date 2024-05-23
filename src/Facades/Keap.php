<?php

namespace KeapGeek\Keap\Facades;

use KeapGeek\Keap\ServiceFactory;
use KeapGeek\Keap\Mock\MockFactory;
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
