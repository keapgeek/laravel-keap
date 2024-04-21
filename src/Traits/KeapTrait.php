<?php

namespace Azzarip\Keap\Traits;

use Azzarip\Keap\Facades\Keap;

trait KeapTrait
{
    public function hasKeap(): bool
    {
        return (bool) $this->keap_id;
    }

    public function achieveGoal()
    {
        if (!$this->hasKeap()) {
            $this->update(['keap_id' => $this->createKeapId()]);
        }
    }

    protected function createKeapId(): int
    {
        $response = Keap::contact()->createOrUpdate($this->toKeapApi());
        return $response['id'];
    }

    protected function toKeapApi(): array
    {

        $keapConfig = array_merge(['email' => 'email'], $this->keap, );
        $payload = [];

        foreach($keapConfig as $key => $value) {
            if($key === 'email') {
                $payload['email_addresses'] = [[
                    'address' => $this->$value,
                    'field' => 'EMAIL1'
                    ]];
                continue;
            }
            $payload[$key] = $this->$value;
        }

        return $payload;
    }
}
