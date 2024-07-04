<?php

namespace KeapGeek\Keap\Services\V1;

use KeapGeek\Keap\Services\Service;

class Order extends Service
{
    protected $uri = '/v1/orders';

    public function list(array $data = [])
    {

        $this->parseDatetime('since', $data);
        $this->parseDatetime('until', $data);

        $list = $this->get('/', $data);

        return $list['orders'];
    }

    public function count(array $data = [])
    {

        $this->parseDatetime('since', $data);
        $this->parseDatetime('until', $data);

        $list = $this->get('/', $data);

        return $list['count'];
    }

    public function create(array $data = [])
    {
        return $this->post('/', $data);
    }

    public function find(int $order_id)
    {
        return $this->get("/$order_id");
    }

    public function delete(int $order_id)
    {
        return $this->del("/$order_id");
    }

    public function model()
    {
        return $this->get('/model');
    }

    public function createItem(int $order_id, array $data)
    {
        return $this->post("/$order_id/items", $data);
    }

    public function deleteItem(int $order_id, int $item_id)
    {
        return $this->del("/$order_id/items/$item_id");
    }

    public function subscriptionModel()
    {
        $this->client->setUri('/v1/subscriptions');

        return $this->get('/model');
    }

    public function listSubscriptions(array $data = [])
    {
        $this->client->setUri('/v1/subscriptions');
        $list = $this->get('/', $data);

        return $list['subscriptions'];
    }

    public function createSubscription(array $data)
    {
        $this->parseDate('first_bill_date', $data);

        $this->client->setUri('/v1/subscriptions');

        return $this->post('/', $data);
    }

    public function listTransactions(array $data = [])
    {
        $this->parseDatetime('since', $data);
        $this->parseDatetime('until', $data);

        $this->client->setUri('/v1/transactions');
        $list = $this->get('/', $data);

        return $list['transactions'];
    }

    public function findTransaction(int $transaction_id)
    {
        $this->client->setUri('/v1/transactions');

        return $this->get("/$transaction_id");
    }

    public function findOrderTransactions(int $order_id, array $data = [])
    {
        $this->parseDatetime('since', $data);
        $this->parseDatetime('until', $data);

        $list = $this->get("/$order_id/transactions", $data);

        return $list['transactions'];
    }

    public function replacePayPlan(int $order_id, array $data = [])
    {
        $this->parseDate('initial_payment_date', $data);
        $this->parseDate('plan_start_date', $data);

        return $this->put("/$order_id/paymentPlan", $data);
    }

    public function findPayments(int $order_id)
    {
        return $this->get("/$order_id/payments");
    }

    public function createPayment(int $order_id, array $data)
    {
        $this->parseDatetime('date', $data);

        return $this->post("/$order_id/payments", $data);
    }
}
