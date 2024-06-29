<?php

namespace KeapGeek\Keap\Services;

use Illuminate\Support\Carbon;

class Order extends Service
{
    protected $uri = '/v1/orders';

    public function list(array $data = [])
    {

        $this->parseDate('since', $data);
        $this->parseDate('until', $data);

        $list = $this->client->get('/', $data);

        return $list['orders'];
    }

    public function count(array $data = [])
    {

        $this->parseDate('since', $data);
        $this->parseDate('until', $data);

        $list = $this->client->get('/', $data);

        return $list['count'];
    }

    public function create(array $data = [])
    {
        return $this->client->post('/', $data);
    }

    public function find(int $order_id)
    {
        return $this->client->get("/$order_id");
    }

    public function delete(int $order_id)
    {
        return $this->client->delete("/$order_id");
    }

    public function model()
    {
        return $this->client->get('/model');
    }

    public function createItem(int $order_id, array $data)
    {
        return $this->client->post("/$order_id/items", $data);
    }

    public function deleteItem(int $order_id, int $item_id)
    {
        return $this->client->delete("/$order_id/items/$item_id");
    }

    public function subscriptionModel()
    {
        $this->client->setUri('/v1/subscriptions');
        return $this->client->get('/model');
    }

    public function listSubscriptions(array $data = [])
    {
        $this->client->setUri('/v1/subscriptions');
        $list = $this->client->get('/', $data);
        return $list['subscriptions'];
    }

    public function createSubscription(array $data)
    {
        $this->client->setUri('/v1/subscriptions');
        return $this->client->post('/', $data);
    }


    public function listTransactions(array $data = [])
    {
        $this->client->setUri('/v1/transactions');
        $list = $this->client->get('/', $data);
        return $list['transactions'];
    }

    public function findTransaction(int $transaction_id)
    {
        $this->client->setUri('/v1/transactions');
        return $this->client->get("/$transaction_id");
    }
    public function findOrderTransactions(int $order_id, array $data = [])
    {
        $list = $this->client->get("/$order_id/transactions", $data);
        return $list['transactions'];
    }

    public function replacePayPlan(int $order_id, array $data = [])
    {
        return $this->client->put("/$order_id/paymentPlan", $data);
    }

    public function findPayments(int $order_id)
    {
        return $this->client->get("/$order_id/payments");
    }

    public function createPayment(int $order_id, array $data)
    {
        return $this->client->post("/$order_id/payments", $data);
    }
}
