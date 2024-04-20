<?php

namespace Azzarip\Keap;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class Client
{
    protected string $url;

    protected $request;

    public function __construct($bearer = null)
    {
        $this->request = Http::asForm();

        if($bearer){
            $this->request = $this->request->withHeaders([
                'Authorization' =>  'Bearer ' . $bearer,
                'Content-Type' => 'application/json'
            ]);
        }

        $this->url = 'https://api.infusionsoft.com';
    }

    public function auth() {
        $this->request = $this->request->withBasicAuth(config('keap.client_key'), config('keap.client_secret'));
        return $this;
    }

    public function get($uri = null)
    {
        return $this->call('get', $uri);
    }
    public function post($uri, $postData) {
        return $this->call('post', $uri, $postData);
    }

    protected function call($method, $uri = '', $data = null)
    {
        $response = $this->request->$method($this->url . $uri, $data);

        return $this->checkResponse($response);
    }
    public function setUri(string $uri = '')
    {

        if(empty($uri)){ return; }

        $uri = trim($uri, '/');
        if(Str::startsWith($uri, 'v1'))
        {
            $this->url .=  '/crm/rest/v1/'. trim($uri, '/');
        }

    }

    protected function checkResponse($response)
    {
        $status = $response->getStatusCode();

        if($status === 401){
            throw new InvalidTokenException();
        }

        $content = $response->getBody()->getContents();
        return json_decode($content, true);
    }

}
