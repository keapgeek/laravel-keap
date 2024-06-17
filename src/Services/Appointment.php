<?php

namespace KeapGeek\Keap\Services;

use Illuminate\Support\Carbon;

class Appointment extends Service
{
    protected $uri = '/v1/appointments';

    public function model()
    {
        return $this->client->get('/model');
    }

    public function create(array $data)
    {
        if (array_key_exists('start_date', $data)) {
            $data['start_date'] = Carbon::parse($data['start_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('end_date', $data)) {
            $data['end_date'] = Carbon::parse($data['end_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('user_id', $data)) {
            $data['user'] = $data['user_id'];
            unset($data['user_id']);
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

        if (array_key_exists('user_id', $data)) {
            $data['user'] = $data['user_id'];
            unset($data['user_id']);
        }

        $list = $this->client->get('/', $data);

        return $list['appointments'];
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

    public function update(int $appointment_id, array $data)
    {
        if (array_key_exists('start_date', $data)) {
            $data['start_date'] = Carbon::parse($data['start_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('end_date', $data)) {
            $data['end_date'] = Carbon::parse($data['end_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('user_id', $data)) {
            $data['user'] = $data['user_id'];
            unset($data['user_id']);
        }

        return $this->client->patch("/$appointment_id", $data);
    }

    public function replace(int $appointment_id, array $data)
    {
        if (array_key_exists('start_date', $data)) {
            $data['start_date'] = Carbon::parse($data['start_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('end_date', $data)) {
            $data['end_date'] = Carbon::parse($data['end_date'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('user_id', $data)) {
            $data['user'] = $data['user_id'];
            unset($data['user_id']);
        }

        return $this->client->put("/$appointment_id", $data);
    }

    public function find(int $id)
    {
        return $this->client->get("/$id");
    }
}
