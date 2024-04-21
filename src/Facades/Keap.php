<?php

namespace Azzarip\Keap\Facades;

use Azzarip\Keap\Services;

class Keap
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
}
