<?php

namespace Azzarip\Keap;

use Illuminate\Support\Facades\Cache;

class Keap
{
    public static function token() {
        return new Token();
    }

}
