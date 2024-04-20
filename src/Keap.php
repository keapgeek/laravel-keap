<?php

namespace Azzarip\Keap;

use Azzarip\Keap\Services\TokenService;
use Azzarip\Keap\Services\ContactService;

class Keap
{
    public static function token()
    {
        return new TokenService();
    }

    public static function contact()
    {
        return new ContactService();
    }
}
