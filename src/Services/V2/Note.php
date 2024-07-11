<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Note extends Service
{
    protected $uri = '/v2/contacts';

    public function list(int $contact_id, array $data = [])
    {
        $list = $this->get("/$contact_id/notes", $data);

        return $list['notes'];
    }

    public function delete(int $note_id, int $contact_id)
    {
        return $this->del("/$contact_id/notes/$note_id");
    }

    public function update(int $note_id, int $contact_id, array $data)
    {
        return $this->patch("/$contact_id/notes/$note_id", $data);
    }

    public function create(int $contact_id, array $data)
    {
        return $this->post("/$contact_id/notes", $data);
    }

    public function find(int $note_id, int $contact_id)
    {
        return $this->get("/$contact_id/notes/$note_id");
    }
}
