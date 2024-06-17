<?php

namespace KeapGeek\Keap\Services;

use Illuminate\Support\Carbon;

class Task extends Service
{
    protected $uri = '/v1/tasks';

    public function model()
    {
        return $this->client->get('/model');
    }

    public function create(array $data)
    {
        if (array_key_exists('completion_date', $data)) {
            $data['completion_date'] = Carbon::parse($data['completion_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('creation_date', $data)) {
            $data['creation_date'] = Carbon::parse($data['creation_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('due_date', $data)) {
            $data['due_date'] = Carbon::parse($data['due_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('modification_date', $data)) {
            $data['modification_date'] = Carbon::parse($data['modification_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('contact_id', $data)) {
            $data['contact'] = [
                'id' => $data['contact_id'],
            ];
            unset($data['contact_id']);
        }

        return $this->client->post('/', $data);
    }

    public function list(array $data = [])
    {

        if (array_key_exists('since', $data)) {
            $data['since'] = Carbon::parse($data['since'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('until', $data)) {
            $data['until'] = Carbon::parse($data['until'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        $list = $this->client->get('/', $data);

        return $list['tasks'];
    }

    public function search(array $data = [])
    {

        if (array_key_exists('since', $data)) {
            $data['since'] = Carbon::parse($data['since'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('until', $data)) {
            $data['until'] = Carbon::parse($data['until'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        $list = $this->client->get('/search', $data);

        return $list['tasks'];
    }

    public function count(array $data = [])
    {
        if (array_key_exists('since', $data)) {
            $data['since'] = Carbon::parse($data['since'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('until', $data)) {
            $data['until'] = Carbon::parse($data['until'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        $list = $this->client->get('/', $data);

        return $list['count'];
    }

    public function delete(int $id)
    {
        return $this->client->delete("/$id");
    }

    public function update(int $task_id, array $data)
    {
        if (array_key_exists('completion_date', $data)) {
            $data['completion_date'] = Carbon::parse($data['completion_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('creation_date', $data)) {
            $data['creation_date'] = Carbon::parse($data['creation_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('due_date', $data)) {
            $data['due_date'] = Carbon::parse($data['due_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('modification_date', $data)) {
            $data['modification_date'] = Carbon::parse($data['modification_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        return $this->client->patch("/$task_id", $data);
    }

    public function replace(int $task_id, array $data)
    {
        if (array_key_exists('completion_date', $data)) {
            $data['completion_date'] = Carbon::parse($data['completion_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('creation_date', $data)) {
            $data['creation_date'] = Carbon::parse($data['creation_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('due_date', $data)) {
            $data['due_date'] = Carbon::parse($data['due_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('modification_date', $data)) {
            $data['modification_date'] = Carbon::parse($data['modification_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        return $this->client->put("/$task_id", $data);
    }

    public function find(int $id)
    {
        return $this->client->get("/$id");
    }
}
