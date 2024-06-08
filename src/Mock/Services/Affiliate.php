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

        return $this->fakeAffiliate([
            'contact_id' => $contact_id,
            'code' => $code,
            'name' => $name ?? fake()->name(),
            'notify_on_lead' => $notify_on_lead,
            'notify_on_sale' => $notify_on_sale,
            'parent_id' => $parent_id,
            'status' => $status,
            'track_leads_for' => $track_leads_for,
        ]);
    }

    public function model()
    {
        return [
            'custom_fields' => [],
            'optional_properties' => null,
        ];
    }

    public function list(array $data = [])
    {
        $list = array_map(function () {
            return $this->fakeAffiliate();
        }, range(1, 10));
        return ['affiliates' => $list];
    }

    public function find(int $id) {
        return $this->fakeAffiliate(['id' => $id]);
    }

    protected function fakeAffiliate(array $data = []){
        return array_merge([
            'id' => fake()->randomNumber(3),
            'contact_id' => fake()->randomNumber(3),
            'code' => fake()->word(),
            'name' => fake()->name(),
            'notify_on_lead' => fake()->boolean(),
            'notify_on_sale' => fake()->boolean(),
            'parent_id' => fake()->randomNumber(2),
            'status' => fake()->boolean() ? 'active' : 'inactive',
            'track_leads_for' => 0,
            ], $data);
    }

    public function count(array $data = [])
    {
        return 1;
    }
    public function commissions(array $data = [])
    {
        return [];
    }

    public function programs(array $data = [])
    {
        return [];
    }

    public function redirects(array $data = [])
    {
        return [];
    }
}
