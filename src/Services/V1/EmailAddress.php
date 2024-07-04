<?php

namespace KeapGeek\Keap\Services\V1;

use KeapGeek\Keap\Services\Service;

class EmailAddress extends Service
{
    protected $uri = '/v1/emailAddresses';

    public function replace(string $email, bool $opted_in, ?string $opt_in_reason = null)
    {
        $this->put("/$email", [
            'opted_in' => $opted_in,
            'reason' => $opt_in_reason ?? config('keap.opt_in_reason'),
        ]);
    }
}
