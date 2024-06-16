<?php

namespace KeapGeek\Keap\Mock\Services;

class Campaign
{
    public function list(array $data = [])
    {
        return [];
    }

    public function count(array $data = [])
    {
        return 10;
    }

    public function find(int $campaign_id, array $optional_properties = [])
    {
        return null;
     }

    public function achieve(int $contact_id, string $callName, ?string $integration = null)
    {
        return true;
    }

    public function addToSequence(array | int $ids, int $campaign_id, int $sequence_id)
    {
        return true;
    }

    public function removeFromSequence(array | int $ids, int $campaign_id, int $sequence_id)
    {
        return true;
    }
}
