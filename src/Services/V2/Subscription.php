<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Subscription extends Service
{
    protected $uri = '/v2/subscriptions';

    public function create(array $data)
    {
        $this->parseDate('first_bill_date', $data);

        return $this->post('/', $data);
    }
}
