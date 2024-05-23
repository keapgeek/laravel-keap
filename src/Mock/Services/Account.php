<?php

namespace Azzarip\Keap\Mock\Services;

class Account
{
    public function retrieve()
    {
        return [
            'name' => fake()->company(),
            'email' => fake()->companyEmail(),
            'website' => fake()->url(),
            'phone' => fake()->phoneNumber(),
            'address' => [
                'line1' => fake()->streetAddress(),
                'line2' => fake()->secondaryAddress(),
                'locality' => fake()->city(),
                'region' => fake()->state(),
                'field' => 'BILLING',
                'postal_code' => fake()->postcode(),
                'zip_code' => fake()->postcode(),
                'zip_four' => null,
                'country_code' => fake()->countryCode()
            ],
            'phone_ext' => null,
            'time_zone' => fake()->timezone(),
            'logo_url' => fake()->url(),
            'currency_code' => fake()->currencyCode(),
            'language_tag' => str_replace('_', '-', fake()->locale()),
            'business_type' => null,
            'business_goals' => [],
            'business_primary_color' => null,
            'business_secondary_color' => null,
        ];
    }

    public function update(array $data)
    {
        $original = $this->retrieve();

        $data = array_merge($original, $data);

        return $data;
    }
}
