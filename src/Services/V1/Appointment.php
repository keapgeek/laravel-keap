<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Appointment extends Service
{
    protected $uri = '/v1/appointments';

    public function model()
    {
        return $this->get('/model');
    }

    public function create(array $data)
    {
        $this->parseDatetime('start_date', $data);
        $this->parseDatetime('end_date', $data);

        $this->switch('user_id', 'user', $data);

        return $this->post('/', $data);
    }

    public function list(array $data = [])
    {

        $this->parseDatetime('since', $data);
        $this->parseDatetime('until', $data);

        $this->switch('user_id', 'user', $data);

        $list = $this->get('/', $data);

        return $list['appointments'];
    }

    public function count(array $data = [])
    {
        $this->parseDatetime('since', $data);
        $this->parseDatetime('until', $data);

        $list = $this->get('/', $data);

        return $list['count'];
    }

    public function delete(int $id)
    {
        return $this->del("/$id");
    }

    public function update(int $appointment_id, array $data)
    {
        $this->parseDatetime('start_date', $data);
        $this->parseDatetime('end_date', $data);

        $this->switch('user_id', 'user', $data);

        return $this->patch("/$appointment_id", $data);
    }

    public function replace(int $appointment_id, array $data)
    {
        $this->parseDatetime('start_date', $data);
        $this->parseDatetime('end_date', $data);

        $this->switch('user_id', 'user', $data);

        return $this->put("/$appointment_id", $data);
    }

    public function find(int $id)
    {
        return $this->get("/$id");
    }
}
