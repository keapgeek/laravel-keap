<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Tag extends Service
{
    protected $uri = '/v1/tags';


    public function list()
    {
        return $this->client->get('/');
    }

    public function createCategory(string $name, string $description = '')
    {
        return $this->client->post('/categories', [
            'name' => $name,
            'description' => $description
        ]);
    }
}
