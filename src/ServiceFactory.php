<?php

namespace Azzarip\Keap;

use Azzarip\Keap\Services;
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

}
