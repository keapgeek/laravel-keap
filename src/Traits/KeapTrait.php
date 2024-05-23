<?php

namespace KeapGeek\Keap\Traits;

use KeapGeek\Keap\Facades\Keap;

trait KeapTrait
{
    public function hasKeap(): bool
    {
        return (bool) $this->keap_id;
    }

    public function achieveGoal(string $callName)
    {
        if (! $this->hasKeap()) {
            $this->update(['keap_id' => $this->createKeapId()]);
        }

        Keap::campaign()->achieve($this->keap_id, $callName);
    }

    protected function createKeapId(): int
    {
        $response = Keap::contact()->createOrUpdate($this->toKeapApi());

        return $response['id'];
    }

    protected function toKeapApi(): array
    {

        $keapConfig = array_merge(['email' => 'email'], config('keap.contact_data') ?? []);
        $payload = [];

        foreach ($keapConfig as $key => $value) {
            if ($key === 'email') {
                $payload['email_addresses'] = [[
                    'email' => $this->$value,
                    'field' => 'EMAIL1',
                ]];

                continue;
            }
            if ($key === 'phone') {
                $payload['phone_numbers'] = [[
                    'number' => $this->$value,
                    'extension' => 'null',
                    'field' => 'PHONE1',
                    'type' => 'Mobile',
                ]];

                continue;
            }
            $payload[$key] = $this->$value;
        }

        return $payload;
    }
}
