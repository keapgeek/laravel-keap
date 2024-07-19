<?php

namespace KeapGeek\Keap\Services;

use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Exceptions\KeapException;

class Form
{
    public function __construct(string $form_xid, string $infusionsoft_version, array $data, array $headers = [])
    {
        if (empty(config('keap.app_name'))) {
            throw new KeapException('App_name not set in configuration.');
        }
        $data['inf_form_xid'] = $form_xid;
        $data['infusionsoft_version'] = $infusionsoft_version;

        Http::withHeaders($headers)->asForm()->post('https://'.config('keap.app_name').'.infusionsoft.com/app/form/process/'.$form_xid, $data);
    }
}
