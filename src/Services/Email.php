<?php

namespace KeapGeek\Keap\Services;

use Illuminate\Support\Carbon;

class Email extends Service
{
    protected $uri = '/v1/emails';

    public function list(array $data = [])
    {
        if (array_key_exists('since_sent_date', $data)) {
            $data['since_sent_date'] = Carbon::parse($data['since_sent_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('until_sent_date', $data)) {
            $data['until_sent_date'] = Carbon::parse($data['until_sent_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        $list = $this->client->get('/', $data);

        return $list['emails'];
    }

    public function count(array $data = [])
    {
        $list = $this->client->get('/', $data);

        return $list['count'];
    }

    public function find(int $id)
    {
        return $this->client->get("/$id");
    }

    public function delete(int $id)
    {
        return $this->client->delete("/$id");
    }

    public function create(array $data)
    {
        return $this->client->post('/', $data);
    }

    public function send(array $data)
    {
        return $this->client->post('/queue', $data);
    }

    public function createSet(array $emails, array $errors = [])
    {
        return $this->client->post('/sync', [
            'emails' => $emails,
            'errors' => $errors,
        ]);
    }

    public function unsync(array $ids)
    {
        return $this->client->post('/unsync', $ids);
    }
}
