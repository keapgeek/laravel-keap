<?php

namespace KeapGeek\Keap\Mock\Services;

use Carbon\Carbon;

class Campaign
{
    public function list(array $data = [])
    {
        $list = array_map(function () {
            return $this->fakeCampaign();
        }, range(1, 10));
        return ['campaigns' => $list];
    }

    public function count(array $data = [])
    {
        return 10;
    }

    public function find(int $campaign_id, array $optional_properties = [])
    {
        return $this->fakeCampaign(['id' => $campaign_id]);
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

    protected function fakeCampaign(array $data = [])
    {

        return array_merge([
            "active_contact_count" => fake()->randomNumber(2),
            "completed_contact_count" => fake()->randomNumber(2),
            "id" => fake()->randomNumber(2),
            "name" => fake()->company(),
            "date_created" =>  Carbon::parse(fake()->dateTime())->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z'),
            "published_date" =>  Carbon::parse(fake()->dateTime())->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z'),
            "published_status" => true,
            "error_message" => null,
            "time_zone" => fake()->timezone(),
            "published_time_zone" => fake()->timezone(),
        ], $data);
    }
}
