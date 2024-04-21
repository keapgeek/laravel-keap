<?php

namespace Azzarip\Keap;

use Azzarip\Keap\Exceptions\InvalidTokenException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Client
{
    protected string $url;

    protected $request;

    public function __construct($bearer = null)
    {

        $this->request = Http::asForm();

        if ($bearer) {
            $this->request = Http::withHeaders([
                'Authorization' => 'Bearer '.$bearer,
                'Content-Type' => 'application/json',
            ]);
        }

        $this->url = 'https://api.infusionsoft.com';
    }

    public function auth()
    {
        $this->request = $this->request->withBasicAuth(config('keap.client_key'), config('keap.client_secret'));

        return $this;
    }

    public function get($uri = null)
    {
        return $this->call('get', $uri);
    }

    public function post($uri, $data)
    {
        return $this->call('post', $uri, $data);
    }

    protected function call($method, $uri = '', $data = null)
    {
        $url = $this->url.'/'.trim($uri, '/');

        $response = $this->request->$method($url, $data);

        return $this->checkResponse($response);
    }

    public function setUri(string $uri = '')
    {

        if (empty($uri)) {
            return;
        }

        $uri = trim($uri, '/');
        if (Str::startsWith($uri, 'v1')) {
            $this->url .= '/crm/rest/'.$uri;
        }

    }

    protected function checkResponse($response)
    {
        $status = $response->getStatusCode();

        if ($status === 401) {
            throw new InvalidTokenException('Expired Token: go to /keap/auth');
        }

        $content = $response->getBody()->getContents();

        return json_decode($content, true);
    }
}
