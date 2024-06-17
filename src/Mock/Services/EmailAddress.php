<?php

namespace KeapGeek\Keap\Mock\Services;

class Contact
{
    protected $uri = '/v1/emailAddresses';

    public function replace(string $email, bool $opted_in, ?string $opt_in_reason = null)
    {
        return [
            'email' => $email,
            'opted_in' => $opted_in,
            'status' => 'Marketable',
        ];
    }
}
