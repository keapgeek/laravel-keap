<?php

namespace KeapGeek\Keap\Services;

use Illuminate\Support\Carbon;

class Opportunity extends Service
{
    protected $uri = '/v1/opportunities';

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['opportunities'];
    }

    public function count(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['count'];
    }

    public function create(array $data)
    {

        if (array_key_exists('contact_id', $data)) {
            $data['contact'] = [
                'id' => $data['contact_id'],
            ];
            unset($data['contact_id']);
        }

        if (array_key_exists('user_id', $data)) {
            $data['user'] = [
                'id' => $data['user_id'],
            ];
            unset($data['user_id']);
        }

        if (array_key_exists('stage_id', $data)) {
            $data['stage'] = [
                'id' => $data['stage_id'],
            ];
            unset($data['stage_id']);
        }

        if (array_key_exists('date_created', $data)) {
            $data['date_created'] = Carbon::parse($data['date_created'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        return $this->post('/', $data);
    }

    public function update(int $opportunity_id, array $data = [])
    {
        if (array_key_exists('contact_id', $data)) {
            $data['contact'] = [
                'id' => $data['contact_id'],
            ];
            unset($data['contact_id']);
        }

        if (array_key_exists('user_id', $data)) {
            $data['user'] = [
                'id' => $data['user_id'],
            ];
            unset($data['user_id']);
        }

        if (array_key_exists('stage_id', $data)) {
            $data['stage'] = [
                'id' => $data['stage_id'],
            ];
            unset($data['stage_id']);
        }

        if (array_key_exists('date_created', $data)) {
            $data['date_created'] = Carbon::parse($data['date_created'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        return $this->patch("/$opportunity_id", $data);
    }

    public function replace(array $data = [])
    {
        if (array_key_exists('contact_id', $data)) {
            $data['contact'] = [
                'id' => $data['contact_id'],
            ];
            unset($data['contact_id']);
        }

        if (array_key_exists('user_id', $data)) {
            $data['user'] = [
                'id' => $data['user_id'],
            ];
            unset($data['user_id']);
        }

        if (array_key_exists('stage_id', $data)) {
            $data['stage'] = [
                'id' => $data['stage_id'],
            ];
            unset($data['stage_id']);
        }

        if (array_key_exists('date_created', $data)) {
            $data['date_created'] = Carbon::parse($data['date_created'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        return $this->put('/', $data);
    }

    public function find(int $opportunity_id, array $optional_properties = [])
    {
        if (empty($optional_properties)) {
            return $this->get("/$opportunity_id");
        }

        return $this->get("/$opportunity_id", [
            'optional_properties' => implode(',', $optional_properties),
        ]);
    }

    public function model()
    {
        return $this->get('/model');
    }

    public function pipeline()
    {
        $this->client->setUri('/v1/opportunity');

        return $this->get('/stage_pipeline');
    }
}
