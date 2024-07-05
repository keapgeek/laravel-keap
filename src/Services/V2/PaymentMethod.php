<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class PaymentMethod extends Service
{
    protected $uri = '/v2/paymentMethodConfigs';

    public function createKey(int $contact_id)
    {
        return $this->post('/', [
            'contact_id' => (string) $contact_id,
        ]);
    }
}
