<?php

namespace KeapGeek\Keap\Services;

class Product extends Service
{
    protected $uri = '/v1/products';

    public function list(array $data = [])
    {
        $list = $this->client->get('/', $data);
        return $list['products'];
    }

    public function count(array $data = [])
    {
        $list = $this->client->get('/', $data);
        return $list['count'];
    }

    public function create(array $data)
    {
        return $this->client->post('/', $data);
    }

    public function update(int $product_id, array $data = [])
    {
        return $this->client->patch("/$product_id", $data);
    }

    public function find(int $product_id)
    {
        return $this->client->get("/$product_id");
    }

    public function delete(int $product_id)
    {
        return $this->client->delete("/$product_id");
    }

    public function createSubscription(int $product_id, array $data = [])
    {
        return $this->client->post("/$product_id/subscriptions", $data);
    }

    public function findSubscription(int $product_id, int $subscription_id)
    {
        return $this->client->get("/$product_id/subscriptions/$subscription_id");
    }

    public function deleteSubscription(int $product_id, int $subscription_id)
    {
        return $this->client->delete("/$product_id/subscriptions/$subscription_id");
    }

    public function uploadImage(int $product_id, array $data)
    {
        return $this->client->post("/$product_id/image", $data);
    }

    public function deleteImage(int $product_id)
    {
        return $this->client->delete("/$product_id/image");
    }
}
