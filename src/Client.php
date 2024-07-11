<?php

namespace KeapGeek\Keap;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use KeapGeek\Keap\Exceptions\BadRequestException;
use KeapGeek\Keap\Exceptions\InvalidTokenException;
use KeapGeek\Keap\Exceptions\ServerErrorException;

class Client
{
    protected string $url;

    protected string $base_url = 'https://api.infusionsoft.com/crm/rest/';

    protected $request;

    public function __construct($bearer = null)
    {
        $this->request = Http::withHeaders([
            'Authorization' => 'Bearer '.$bearer,
            'Content-Type' => 'application/json',
        ]);
    }

    public function call($method, $uri = '/', $data = null)
    {

        $url = $this->prepareUrl($uri);

        return retry(config('keap.retry_times'),

            function () use ($method, $url, $data) {

                return $this->sendRequest($method, $url, $data);

            },

            config('keap.retry_delay'),

            function (\Exception $e) {
                return $e instanceof ServerErrorException;
            });
    }

    protected function sendRequest($method, $url, $data)
    {
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
        return $this->url.rtrim($uri, '/');
    }

    public function setUri(string $uri = '')
    {
        $this->url = $this->base_url;
        $uri = trim($uri, '/');
        $this->url .= $uri;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
