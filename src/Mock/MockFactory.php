<?php

namespace KeapGeek\Keap\Mock;

class MockFactory
{
    public function account()
    {
        return new Services\Account();
    }



    public static function contact()
    {
        return new Services\Contact();
    }
}
