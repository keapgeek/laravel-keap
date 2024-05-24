<?php

namespace KeapGeek\Keap;

class ServiceFactory
{
    public function account()
    {
        return new Services\Account();
    }
    public function affiliate()
    {
        return new Services\Affiliate();
    }
    public function company()
    {
        return new Services\Company();
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
