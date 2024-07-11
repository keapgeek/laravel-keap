<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Email extends Service
{
    protected $uri = '/v2/emails';

    public function find(int $id)
    {
        return $this->get("/$id");
    }

    public function delete(int $id)
    {
        return $this->del("/$id");
    }

    public function create(array $data)
    {
        $this->parseDatetime('clicked_time', $data);
        $this->parseDatetime('opened_time', $data);
        $this->parseDatetime('sent_time', $data);
        $this->parseDatetime('received_time', $data);

        return $this->post('/', $data);
    }

    public function send(array $data)
    {
        $this->encode64('html_content', $data);
        $this->encode64('plain_content', $data);

        return $this->post(':send', $data);
    }

    public function createSet(array $emails)
    {
        return $this->post(':batchAdd', [
            'emails' => $emails,
        ]);
    }

    public function removeSet(array $email_ids)
    {
        return $this->post(':batchRemove', [
            'email_ids' => $email_ids,
        ]);
    }
}
