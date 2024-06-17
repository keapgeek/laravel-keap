<?php

namespace KeapGeek\Keap\Mock\Services;

class EmailAddress
{
    public function replace(string $email, bool $opted_in, ?string $opt_in_reason = null)
    {
        return [
            'email' => $email,
            'opted_in' => $opted_in,
            'status' => 'Marketable',
        ];
    }
}
