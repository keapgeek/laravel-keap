<?php

namespace KeapGeek\Keap\Mock\Services;

use function Symfony\Component\String\b;

class Task
{
    public function emailSignature()
    {
        $htmlString = "<b>" . fake()->name() . "</b><br />" . fake()->email();
        return $htmlString;
    }

    public function create(array $data)
    {
        $id = fake()->randomNumber(5);
        return [
        "address" => null,
        "website" => null,
        "partner" => $data['partner'] ?? false,
        "status" => "Invited",
        "company_name" => "",
        "email_address" => $data['email'],
        "phone_numbers" => [],
        "fax_numbers" => [],
        "given_name" => $data['given_name'],
        "family_name" => "",
        "middle_name" => null,
        "preferred_name" => $data['given_name'],
        "time_zone" => null,
        "job_title" => null,
        "infusionsoft_id" => fake()->bothify('???###-') . fake()->md5(),
        "date_created" => now(),
        "created_by" => $id,
        "last_updated" => now(),
        "last_updated_by" => $id,
        "global_user_id" => null,
        "id" => $id + 1 + fake()->randomNumber(2),
        ];
    }

}
