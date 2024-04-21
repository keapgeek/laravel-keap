<?php

namespace Azzarip\Keap\Mock;

use Azzarip\Keap\Mock\Services;
class FakeFacade
{
    public static function contact()
    {
        return new Services\Contact();
    }

}
