<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Order extends Service
{
    protected $uri = '/v2/orders';

    public function createPayment(int $order_id, array $data = [])
    {
        $this->parseDatetime('date', $data);
        return $this->post("/$order_id/payments", $data);
    }
}
