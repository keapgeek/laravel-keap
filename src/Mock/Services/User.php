<?php

namespace KeapGeek\Keap\Mock\Services;

class User
{
    public function emailSignature()
    {
        $htmlString = '<b>'.fake()->name().'</b><br />'.fake()->email();

        return $htmlString;
    }

    public function create(string $email, string $given_name, bool $admin = false, bool $partner = false)
    {
        $id = fake()->randomNumber(5);

        return [
            'address' => null,
            'website' => null,
            'partner' => $partner,
            'status' => 'Invited',
            'company_name' => '',
            'email_address' => $email,
            'phone_numbers' => [],
            'fax_numbers' => [],
            'given_name' => $given_name,
            'family_name' => '',
            'middle_name' => null,
            'preferred_name' => $given_name,
            'time_zone' => null,
            'job_title' => null,
            'infusionsoft_id' => fake()->bothify('???###-').fake()->md5(),
            'date_created' => now(),
            'created_by' => $id,
            'last_updated' => now(),
            'last_updated_by' => $id,
            'global_user_id' => null,
            'id' => $id + 1 + fake()->randomNumber(2),
        ];
    }
}
