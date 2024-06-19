<?php

namespace KeapGeek\Keap\Services;

class Opportunity extends Service
{
    protected $uri = '/v1/opportunities';

    public function list(array $data = [])
    {
        $list = $this->client->get('/', $data);
        return $list['opportunities'];
    }

    public function count(array $data = [])
    {
        $list = $this->client->get('/', $data);
        return $list['count'];
    }

    public function create(array $data)
    {
        $this->client->post('/', $data);
    }

    public function update(int $opportunity_id, array $data = [])
    {
        $this->client->patch("/$opportunity_id", $data);
    }

    public function replace(array $data = [])
    {
        $this->client->put('/', $data);
    }

    public function find(int $opportunity_id, array $optional_properties = [])
    {
        if(empty($optional_properties)) {
            return $this->client->get("/$opportunity_id");
        }

        return $this->client->get("/$opportunity_id", [
            'optional_properties' => implode(',', $optional_properties),
        ]);
    }

    public function model()
    {
        return $this->client->get('/model');
    }

    public function pipeline()
    {
        return $this->client->get('/stage_pipeline');
    }
}
