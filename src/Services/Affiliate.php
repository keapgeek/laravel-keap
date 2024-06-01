<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Affiliate extends Service
{
    protected $uri = '/v1/affiliates';

    public function find(int $id)
    {
        return $this->client->get("/$id");
    }

    public function create(string $code, int $contact_id, string $password,
        ?string $name = null,
        bool $notify_on_lead = true,
        bool $notify_on_sale = true,
        ?int $parent_id = null,
        bool $active = true,
        ?int $track_leads_for = null )
    {

        $status = $active ? 'active' : 'inactive';

        return $this->client->post('/', [
            'code' => $code,
            'contact_id' => $contact_id,
            'password' => $password,
            'name' => $name,
            'notify_on_lead' => $notify_on_lead,
            'notify_on_sale' => $notify_on_sale,
            'parent_id' => $parent_id,
            'status' => $status,
            'track_leads_for' => $track_leads_for
        ]);
    }

    public function model()
    {
        return $this->client->get('/model');
    }
}
