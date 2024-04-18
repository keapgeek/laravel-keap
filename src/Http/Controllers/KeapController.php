<?php

namespace Azzarip\Keap\Http\Controllers;

use Illuminate\Support\Arr;
use Azzarip\Keap\Facades\Keap;
use Illuminate\Routing\Controller;

class KeapController extends Controller
{
    public function auth()
    {
        $url = 'https://accounts.infusionsoft.com/app/oauth/authorize';

        $data = [
            'client_id' => config('keap.client_key'),
            'redirect_uri' => url('/keap/callback'),
            'response_type' => 'code',
            'scope' => 'full',
        ];

        $url .= '?' . Arr::query($data);

        return redirect(urldecode($url));
    }

    public function callback()
    {
        $code = request('code');

        if(empty($code)) {return 'Missing callback code!';}

        Keap::token()->request($code);

        return "Access granted!";
    }
}
