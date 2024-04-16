<?php

namespace Azzarip\Keap\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Azzarip\Keap\Keap
 */
class Keap extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Azzarip\Keap\Keap::class;
    }
}
