<?php

namespace Azzarip\Keap\Mock\Services;

use Azzarip\Keap\Exceptions\KeapException;

class Contact
{
    public function createOrUpdate(array $data, $duplicate_option = 'Email')
    {
        if (! array_key_exists('email_addresses', $data) && ! array_key_exists('phone_numbers', $data)) {
            throw new KeapException('Missing Email addresses and/or phone numbers');
        }

        $data['duplicate_option'] = $duplicate_option;

        $data['tag_ids'] = [];
        $data['id'] = fake()->random(0, 100);
        $data['date_created'] = now();
        $data['last_updated'] = now();
        return $data;
    }
}
