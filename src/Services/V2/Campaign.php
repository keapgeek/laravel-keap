<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Campaign extends Service
{
    protected $uri = '/v2/campaigns';

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);
        return $list['campaigns'];
    }


    public function find(int $campaign_id)
    {
        return $this->get("/$campaign_id");
    }

    public function addContacts(int $campaign_id, int $sequence_id, array $contact_ids)
    {
        $this->post("/$campaign_id/sequences/$sequence_id:addContacts", [
            'contact_ids' => $contact_ids
        ]);
    }

    public function addContact(int $campaign_id, int $sequence_id, int $contact_id)
    {
        $this->post("/$campaign_id/sequences/$sequence_id:addContacts", [
            'contact_ids' => [$contact_id]
        ]);
    }

    public function removeContacts(int $campaign_id, int $sequence_id, array $contact_ids)
    {
        $this->post("/$campaign_id/sequences/$sequence_id:removeContacts", [
            'contact_ids' => $contact_ids
        ]);
    }

    public function removeContact(int $campaign_id, int $sequence_id, int $contact_id)
    {
        $this->post("/$campaign_id/sequences/$sequence_id:removeContacts", [
            'contact_ids' => [$contact_id]
        ]);
    }
}
