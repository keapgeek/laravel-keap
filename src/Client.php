<?php

namespace KeapGeek\Keap;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use KeapGeek\Keap\Exceptions\BadRequestException;
use KeapGeek\Keap\Exceptions\InvalidTokenException;
use KeapGeek\Keap\Exceptions\ServerErrorException;

class Client
{
    protected string $url;

    protected string $base_url = 'https://api.infusionsoft.com';
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

    }

    public function auth()
    {
        $this->request = $this->request->withBasicAuth(config('keap.client_key'), config('keap.client_secret'));

        return $this;
    }

    public function get($uri = '/', ?array $data = null)
    {
        return $this->call('get', $uri, $data);
    }

    public function post($uri, $data)
    {
        return $this->call('post', $uri, $data);
    }

    public function put($uri, $data)
    {
        return $this->call('put', $uri, $data);
    }

    public function delete($uri, $data = null)
    {
        return $this->call('delete', $uri, $data);
    }

    public function patch($uri, $data)
    {
        return $this->call('patch', $uri, $data);
    }

    protected function call($method, $uri = '', $data = null)
    {
        return retry(config('keap.retry_times'),

            function () use ($method, $uri, $data) {

                return $this->sendRequest($method, $uri, $data);

            },

            config('keap.retry_delay'),

            function (\Exception $e) {
                return $e instanceof ServerErrorException;
            });

    }

    protected function sendRequest($method, $uri, $data)
    {
        $url = $this->prepareUrl($uri);

        $response = $this->tryRequest($method, $url, $data);

        return $this->getResponse($response);
    }

    protected function tryRequest($method, $url, $data)
    {
        try {

            return $this->request->$method($url, $data);

        } catch (RequestException $e) {

            if ($e->getCode() == 400 || $e->getCode() == 500) {
                $message = json_decode($e->response->body(), true)['message'];
                throw new BadRequestException($message);
            }

            if ($e->getCode() == 401) {
                throw new InvalidTokenException('Expired Token: go to /keap/auth');
            }

            if ($e->getCode() == 403) {
                $message = json_decode($e->response->body(), true)['message'];
                throw new BadRequestException($message.'. Wrong Keap version.');
            }

            if ($e->getCode() == 404) {
                return null;
            }
        }
    }

    protected function getResponse($response)
    {
        if (is_null($response)) {
            return null;
        }

        if ($response->status() == 204) {
            return true;
        }

        $content = $response->getBody()->getContents();

        if (strpos($response->getHeaderLine('Content-Type'), 'text/plain') === true) {
            return $content;
        }

        return json_decode($content, true);
    }

    protected function prepareUrl(string $uri): string
    {
        return $this->url.'/'.trim($uri, '/');
    }

    public function setUri(string $uri = '')
    {

        if (empty($uri)) {
            return;
        }

        $this->url = $this->base_url;
        $uri = trim($uri, '/');
        if (Str::startsWith($uri, 'v1')) {
            $this->url .= '/crm/rest/'.$uri;
        }

    }
}
