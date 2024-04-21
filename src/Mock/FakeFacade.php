<?php

namespace Azzarip\Keap\Mock;

class FakeFacade
{
    public static function contact()
    {
        return new Services\Contact();
    }
}
