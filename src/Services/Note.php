<?php

namespace KeapGeek\Keap\Services;

class Note extends Service
{
    protected $uri = '/v1/notes';

    public function find(int $id)
    {
        return $this->client->get("/$id");
    }

    public function list(array $data = [])
    {
        $list = $this->client->get('/', $data);

        return $list['notes'];
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

    public function update(int $note_id, array $data)
    {
        return $this->client->patch("/$note_id", $data);
    }

    public function replace(int $note_id, array $data)
    {
        return $this->client->put("/$note_id", $data);
    }

    public function create(array $data)
    {
        return $this->client->post('/', $data);
    }

    public function model()
    {
        return $this->client->get('/model');
    }
}
