<?php

namespace KeapGeek\Keap\Mock\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Company
{
    public function model()
    {
        return [
            'custom_fields' => [],
            'optional_properties' => null,
        ];
    }

    public function create(array $data)
    {
        if (!array_key_exists('company_name', $data) || is_null($data['company_name'])) {
            throw new ValidationException('Required: company_name');
        }

        return $this->fakeCompany($data);
    }

    public function find($company_id, array $data = [])
    {
        return $this->fakeCompany(['id' => $company_id] + $data);
    }

    protected function fakeCompany(array $data): array
    {
        return array_merge([
            'id' => fake()->randomNumber(3),
            'company_name' => fake()->company(),
            'fax_number' => [],
            'website' => fake()->url(),
            'notes' => [],
            'email_status' => 'Confirmed',
            'email_opted_in' => true,
            'email_address' => fake()->companyEmail(),
            'custom_fields' => [],
            'address' => [],
        ], $data);
    }


}
