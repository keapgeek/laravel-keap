<?php

namespace KeapGeek\Keap\Services;

use Illuminate\Support\Facades\Http;

class Form
{
    public function __construct(string $form_xid, array $data, array $headers = [])
    {
        if (empty(config('keap.app_name'))) {
            return;
        }
        $data['inf_form_xid'] = $form_xid;
        //$data['inf_form_name'] = 'Web Form Submitted';

        Http::withHeaders($headers)->asForm()->post('https://'.config('keap.app_name').'.infusionsoft.com/app/form/process/'.$form_xid, $data);
    }
}
