<?php

namespace Azzarip\Keap;

class ServiceFactory
{
    public function account()
    {
        return new Services\Account();
    }
    public function token()
    {
        return new Services\Token();
    }

    public function contact()
    {
        return new Services\Contact();
    }

    public function campaign()
    {
        return new Services\Campaign();
    }

    public function job()
    {
        return new Services\Job();
    }
}
