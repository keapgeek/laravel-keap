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
    public function appointment()
    {
        return new Services\Appointment();
    }
    public function company()
    {
        return new Services\Company();
    }


    public function contact()
    {
        return new Services\Contact();
    }

    public function order()
    {
        return new Services\Order();
    }
    public function campaign()
    {
        return new Services\Campaign();
    }

    public function note()
    {
        return new Services\Note();
    }
    public function task()
    {
        return new Services\Task();
    }
    public function job()
    {
        return new Services\Job();
    }

    public function token()
    {
        return new Services\Token();
    }
}
