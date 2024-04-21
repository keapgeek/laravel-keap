<?php

namespace Azzarip\Keap;

class ServiceFactory
{
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
