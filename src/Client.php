<?php

namespace Azzarip\Keap;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Azzarip\Keap\Exceptions\ServerErrorException;
use Azzarip\Keap\Exceptions\InvalidTokenException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

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

        $this->request = $this->request->retry(config('keap.retry_times'), config('keap.retry_delay'));

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

    public function put($uri, $data)
    {
        return $this->call('put', $uri, $data);
    }

    protected function call($method, $uri = '', $data = null)
    {
        $response = retry(config('keap.retry_times'),

            function () use ($method, $uri, $data) {
                return $this->sendRequest($method, $uri, $data);
            },

            config('keap.retry_delay'),

            function (\Exception $e) {
                return $e instanceof ServerErrorException;
            });

        return $response;
    }

    protected function sendRequest($method, $uri, $data): array
    {
        $url = $this->url.'/'.trim($uri, '/');

        try {
            $response = $this->request->$method($url, $data);
        } catch (RequestException $e) {
            if($e->getCode() == 400) {
                $message = json_decode($e->response->body(), true)['message'];
                throw new BadRequestException($message);
            }
        }

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

        if ($response->serverError()) {
            throw new ServerErrorException("Server Error (Status Code: {$status})");
        }

        $content = $response->getBody()->getContents();

        return json_decode($content, true);
    }
}
