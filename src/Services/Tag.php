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

    public function create(string $name, string $description = '', ?int $categoryId = null)
    {
        $category = $categoryId ? ['id' => $categoryId] : null;
        return $this->client->post('/', [
            'name' => $name,
            'description' => $description,
            'category' => $category,
        ]);
    }

    public function createCategory(string $name, string $description = '')
    {
        return $this->client->post('/categories', [
            'name' => $name,
            'description' => $description
        ]);
    }
}
