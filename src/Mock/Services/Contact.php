<?php

namespace KeapGeek\Keap\Mock\Services;

use KeapGeek\Keap\Exceptions\KeapException;

class Contact
{

    public function list(array $data = [])
    {
        $list = array_map(function () {
            return $this->fakeContact();
        }, range(1, 10));
        return $list;
    }

    public function find(int $id) {
        return $this->fakeContact(['id' => $id]);
    }

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


    protected function fakeContact(array $data = []): array
    {
        return array_merge([
            'id' => fake()->randomNumber(3),
            'ScoreValue' => null,
            'anniversary' => fake()->dateTimeBetween('-20 years', 'now'),
            'birthday' => fake()->dateTimeBetween('-70 years', '-20 years'),
            'company_name' => fake()->company(),
            'company' => [],
            'date_created' => fake()->dateTimeBetween('-2 years', 'now'),
            'last_updated' => fake()->dateTimeBetween('-1 month', 'now'),
            'family_name' => fake()->lastName(),
            'given_name' => fake()->firstName(),
            'middle_name' => null,
            'fax_number' => [],
            'website' => fake()->url(),
            'email_status' => 'Confirmed',
            'email_opted_in' => true,
            'email_addresses' => [[
                'email' => fake()->safeEmail(),
                'field' => 'EMAIL1',
            ]],
            'owner_id' => fake()->randomNumber(2),
            'phone_numbers' => [],
            'addresses' => [],
        ], $data);
}
}
