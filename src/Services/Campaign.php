<?php

namespace Azzarip\Keap\Services;

class Campaign extends Service
{
    protected $uri = '/v1/campaigns';

    public function list()
    {
        return $this->client->get();
    }

    public function get(int $id)
    {
        return $this->client->get($id);
    }

    public function achieve(int $id, string $callName, ?string $integration = null)
    {
        $integration = $integration ?? config('keap.default_integration');

        return $this->client->post("/goals/{$integration}/{$callName}", [
            'contact_id' => $id,
        ]);
    }
}
