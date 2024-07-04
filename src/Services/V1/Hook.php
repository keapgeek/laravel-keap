<?php

namespace KeapGeek\Keap\Services;

class Hook extends Service
{
    protected $uri = '/v1/hooks';

    public function list()
    {
        return $this->get('/');
    }

    public function types()
    {
        return $this->get('/event_keys');
    }

    public function find(string $key)
    {
        return $this->get("/$key");
    }

    public function delete(string $key)
    {
        return $this->del("/$key");
    }

    public function create(string $event_key, string $hook_url)
    {
        return $this->post('/', [
            'eventKey' => $event_key,
            'hookUrl' => $hook_url,
        ]);
    }

    public function update(string $key, string $event_key, string $hook_url)
    {
        return $this->put("/$key", [
            'eventKey' => $event_key,
            'hookUrl' => $hook_url,
        ]);
    }

    public function verify(string $key)
    {
        return $this->post("/$key/verify", []);
    }
}
