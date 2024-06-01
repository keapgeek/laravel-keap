<?php

namespace KeapGeek\Keap\Mock\Services;

class Affiliate
{
    public function create(string $code, int $contact_id, string $password,
        ?string $name = null,
        bool $notify_on_lead = true,
        bool $notify_on_sale = true,
        ?int $parent_id = null,
        bool $active = true,
        ?int $track_leads_for = null )
    {
        $status = $active ? 'active' : 'inactive';

        return [
            'id' => fake()->randomNumber(3),
            'contact_id' => $contact_id,
            'code' => $code,
            'name' => $name ?? fake()->name(),
            'notify_on_lead' => $notify_on_lead,
            'notify_on_sale' => $notify_on_sale,
            'parent_id' => $parent_id,
            'status' => $status,
            'track_leads_for' => $track_leads_for,
        ];
    }

        public function model()
    {
        return [
            'custom_fields' => [],
            'optional_properties' => null,
        ];
    }

}
