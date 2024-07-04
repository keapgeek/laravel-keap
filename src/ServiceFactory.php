<?php

namespace KeapGeek\Keap;

use KeapGeek\Keap\Services\V2;

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

    public function businessProfile()
    {
        return new V2\BusinessProfile();
    }
    public function campaign()
    {
        return new Services\Campaign();
    }

    public function company()
    {
        return new Services\Company();
    }

    public function contact()
    {
        return new Services\Contact();
    }

    public function email()
    {
        return new Services\Email();
    }

    public function emailAddress()
    {
        return new Services\EmailAddress();
    }

    public function file()
    {
        return new Services\File();
    }

    public function hook()
    {
        return new Services\Hook();
    }

    public function locale()
    {
        return new Services\Locale();
    }

    public function merchant()
    {
        return new Services\Merchant();
    }

    public function opportunity()
    {
        return new Services\Opportunity();
    }

    public function order()
    {
        return new Services\Order();
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

    public function oauth()
    {
        return new Services\Oauth();
    }

    public function product()
    {
        return new Services\Product();
    }

    public function setting()
    {
        return new Services\Setting();
    }

    public function tag()
    {
        return new Services\Tag();
    }

    public function user()
    {
        return new Services\User();
    }

    public function submitForm(string $form_xid, array $data, array $headers = [])
    {
        return new Services\Form($form_xid, $data, $headers);
    }
}
