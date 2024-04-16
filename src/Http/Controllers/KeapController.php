<?php

namespace Azzarip\Keap\Http\Controllers;

use Azzarip\Keap\Keap;
use Illuminate\Support\Arr;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

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

        $response = \Illuminate\Support\Facades\Http::asForm()->post('https://api.infusionsoft.com/token',
        [
            'client_id' => config('keap.client_key'),
            'client_secret' => config('keap.client_secret'),
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => url('/keap/callback'),
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data, true);

        Cache::put('keap.access_token', $data['access_token'], $data['expires_in'] - 1);
        Cache::put('keap.refresh_token', $data['refresh_token'], $data['expires_in'] - 1);

        return "Access granted!";
    }
}
