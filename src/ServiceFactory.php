<?php

namespace KeapGeek\Keap;

use KeapGeek\Keap\Services\V1;
use KeapGeek\Keap\Services\V2;

class ServiceFactory
{
    public function account()
    {
        return new V1\Account();
    }

    public function affiliate($version = null)
    {
        if ($version === 'v2') {
            return new V2\Affiliate();
        }

        return new V1\Affiliate();
    }

    public function appointment()
    {
        return new V1\Appointment();
    }

    public function automation()
    {
        return new V2\Automation();
    }

    public function automationCategory()
    {
        return new V2\AutomationCategory();
    }

    public function businessProfile()
    {
        return new V2\BusinessProfile();
    }

    public function campaign($version = null)
    {
        if ($version === 'v2') {
            return new V2\Campaign();
        }

        return new V1\Campaign();
    }

    public function company($version = null)
    {
        if ($version === 'v2') {
            return new V2\Company();
        }

        return new V1\Company();
    }

    public function contact($version = null)
    {
        if ($version === 'v2') {
            return new V2\Contact();
        }

        return new V1\Contact();
    }

    public function email($version = null)
    {
        if ($version === 'v2') {
            return new V2\Email();
        }

        return new V1\Email();
    }

    public function emailAddress($version = null)
    {
        if ($version === 'v2') {
            return new V2\EmailAddress();
        }

        return new V1\EmailAddress();
    }

    public function file()
    {
        return new V1\File();
    }

    public function funnelIntegration()
    {
        return new V2\FunnelIntegration();
    }

    public function hook()
    {
        return new V1\Hook();
    }

    public function locale()
    {
        return new V1\Locale();
    }

    public function merchant()
    {
        return new V1\Merchant();
    }

    public function opportunity()
    {
        return new V1\Opportunity();
    }

    public function order($version = null)
    {
        if ($version === 'v2') {
            return new V2\Order();
        }

        return new V1\Order();
    }

    public function note($version = null)
    {
        if ($version === 'v2') {
            return new V2\Note();
        }

        return new V1\Note();
    }

    public function paymentMethod()
    {
        return new V2\PaymentMethod();
    }

    public function task()
    {
        return new V1\Task();
    }

    public function job()
    {
        return new Services\Job();
    }

    public function oauth()
    {
        return new V1\Oauth();
    }

    public function product()
    {
        return new V1\Product();
    }

    public function sales()
    {
        return new V2\Sales();
    }

    public function settings($version = null)
    {
        if ($version === 'v2') {
            return new V2\Settings();
        }

        return new V1\Settings();
    }

    public function subscription()
    {
        return new V2\Subscription();
    }

    public function tag($version = null)
    {
        if ($version === 'v2') {
            return new V2\Tag();
        }

        return new V1\Tag();
    }

    public function user()
    {
        return new V1\User();
    }

    public function submitForm(string $form_xid, array $data, array $headers = [])
    {
        return new Services\Form($form_xid, $data, $headers);
    }
}
