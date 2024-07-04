<?php

namespace KeapGeek\Keap\Services;

class Campaign extends Service
{
    protected $uri = '/v1/campaigns';

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['campaigns'];
    }

    public function count(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['count'];
    }

    public function find(int $campaign_id, array $optional_properties = [])
    {
        if (empty($optional_properties)) {
            return $this->get("/$campaign_id");
        }

        return $this->get("/$campaign_id", [
            'optional_properties' => implode(',', $optional_properties),
        ]);
    }

    public function achieve(int $contact_id, string $callName, ?string $integration = null)
    {
        $integration = $integration ?? config('keap.default_integration');

        return $this->post("/goals/{$integration}/{$callName}", [
            'contact_id' => $contact_id,
        ]);
    }

    public function addToSequence(array|int $ids, int $campaign_id, int $sequence_id)
    {
        if (is_int($ids)) {
            $ids = [$ids];
        }

        return $this->post("/{$campaign_id}/sequences/{$sequence_id}/contacts", [
            'ids' => $ids,
        ]);
    }

    public function removeFromSequence(array|int $ids, int $campaign_id, int $sequence_id)
    {
        if (is_int($ids)) {
            $ids = [$ids];
        }

        return $this->del("/{$campaign_id}/sequences/{$sequence_id}/contacts", [
            'ids' => $ids,
        ]);
    }
}
