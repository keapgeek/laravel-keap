<?php

namespace KeapGeek\Keap\Services;

class Note extends Service
{
    protected $uri = '/v1/notes';

    public function find(int $id)
    {
        return $this->get("/$id");
    }

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['notes'];
    }

    public function count(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['count'];
    }

    public function delete(int $id)
    {
        return $this->del("/$id");
    }

    public function update(int $note_id, array $data)
    {
        return $this->patch("/$note_id", $data);
    }

    public function replace(int $note_id, array $data)
    {
        return $this->put("/$note_id", $data);
    }

    public function create(array $data)
    {
        return $this->post('/', $data);
    }

    public function model()
    {
        return $this->get('/model');
    }
}
