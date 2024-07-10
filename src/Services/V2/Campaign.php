<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Campaign extends Service
{
    protected $uri = '/v2/campaigns';

    public function list(array $data = [])
    {
        if(array_key_exists('name', $data)) {
            $data['filter'] = 'name%3D%3D' . $data['name'];
            unset($data['name']);
        }
        $list = $this->get('/', $data);
        return $list['campaigns'];
    }

    public function find(int $campaign_id)
    {
        return $this->get("/$campaign_id");
    }

    public function addToSequence(int $campaign_id, int $sequence_id, array|int $ids)
    {
        if (is_int($ids)) {
            $ids = [$ids];
        }

        return $this->post("/{$campaign_id}/sequences/{$sequence_id}:addContacts", [
            'contact_ids' => $ids,
        ]);
    }

    public function removeFromSequence(int $campaign_id, int $sequence_id, array|int $ids)
    {
        if (is_int($ids)) {
            $ids = [$ids];
        }

        return $this->post("/{$campaign_id}/sequences/{$sequence_id}:removeContacts", [
            'contact_ids' => $ids,
        ]);
    }

}
