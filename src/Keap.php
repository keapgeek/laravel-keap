<?php

namespace Azzarip\Keap;

use Illuminate\Support\Facades\Cache;

class Keap
{


    public static function contact()
    {
        return Client::v1()->post('')
    }
}
