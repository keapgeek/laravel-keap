<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class EmailAddress extends Service
{
    protected $uri = '/v2/emailAddresses';

    public function updateStatus(string $email, bool $opted_in, ?string $opt_in_reason = null)
    {
        $this->put("/$email", [
            'opted_in' => $opted_in,
            'reason' => $opt_in_reason ?? config('keap.opt_in_reason'),
        ]);
    }

    public function find(string $email)
    {
        $this->get("/$email");
    }
}
