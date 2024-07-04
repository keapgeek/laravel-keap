<?php

namespace KeapGeek\Keap\Services;

class Email extends Service
{
    protected $uri = '/v1/emails';

    public function list(array $data = [])
    {
        $this->parseDatetime('since_sent_date', $data);
        $this->parseDatetime('until_sent_date', $data);

        $list = $this->get('/', $data);

        return $list['emails'];
    }

    public function count(array $data = [])
    {
        $this->parseDatetime('since_sent_date', $data);
        $this->parseDatetime('until_sent_date', $data);

        $list = $this->get('/', $data);

        return $list['count'];
    }

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
        $this->parseDatetime('clicked_date', $data);
        $this->parseDatetime('opened_date', $data);
        $this->parseDatetime('sent_date', $data);
        $this->parseDatetime('received_date', $data);

        return $this->post('/', $data);
    }

    public function send(array $data)
    {
        $this->encode64('html_content', $data);
        $this->encode64('plain_content', $data);

        return $this->post('/queue', $data);
    }

    public function createSet(array $emails, array $errors = [])
    {
        return $this->post('/sync', [
            'emails' => $emails,
            'errors' => $errors,
        ]);
    }

    public function unsync(array $ids)
    {
        return $this->post('/unsync', [
            'ids' => $ids,
        ]);
    }
}
