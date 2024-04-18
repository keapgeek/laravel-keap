<?php
namespace Azzarip\Keap;

use Illuminate\Support\Facades\Http;

class Client
{
    protected string $url;

    protected $request;

    protected function __construct($uri = '')
    {
        $this->request = Http::asForm();
        $this->url = 'https://api.infusionsoft.com';
        $this->buildUrl($uri);
    }

    public function auth() {
        $this->request = $this->request->withBasicAuth(config('keap.client_key'), config('keap.client_secret'));
        return $this;
    }

    public static function v1() {
        return new self('/crm/rest/v1');
    }

    public static function token() {
        return new self();
    }
    public function post($uri, $postData) {
        $this->buildUrl($uri);
        $response = $this->request->post($this->url, $postData);
        $data = $response->getBody()->getContents();
        $data = json_decode($data, true);
        return $data;
    }

    protected function buildUrl(string $uri = '')
    {
        if(! empty($uri)){
            $this->url .=  '/'. ltrim($uri, '/');
        }
    }

}
