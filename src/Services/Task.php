<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Task extends Service
{
    protected $uri = '/v1/tasks';


    public function model()
    {
        return $this->client->get('/model');
    }

    public function list(array $data = [])
    {
        $list = $this->client->get('/', $data);
        return $list['tasks'];
    }

    public function count(array $data = [])
    {
        $list = $this->client->get('/', $data);
        return $list['count'];
    }

    public function delete(int $id)
    {
        return $this->client->delete("/$id");
    }

}
