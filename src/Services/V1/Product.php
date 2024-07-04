<?php

namespace KeapGeek\Keap\Services\V1;

use KeapGeek\Keap\Services\Service;

class Product extends Service
{
    protected $uri = '/v1/products';

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['products'];
    }

    public function count(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['count'];
    }

    public function create(array $data)
    {
        return $this->post('/', $data);
    }

    public function update(int $product_id, array $data = [])
    {
        return $this->patch("/$product_id", $data);
    }

    public function find(int $product_id)
    {
        return $this->get("/$product_id");
    }

    public function delete(int $product_id)
    {
        return $this->del("/$product_id");
    }

    public function createSubscription(int $product_id, array $data = [])
    {
        return $this->post("/$product_id/subscriptions", $data);
    }

    public function findSubscription(int $product_id, int $subscription_id)
    {
        return $this->get("/$product_id/subscriptions/$subscription_id");
    }

    public function deleteSubscription(int $product_id, int $subscription_id)
    {
        return $this->del("/$product_id/subscriptions/$subscription_id");
    }

    public function uploadImage(int $product_id, array $data)
    {
        return $this->post("/$product_id/image", $data);
    }

    public function deleteImage(int $product_id)
    {
        return $this->del("/$product_id/image");
    }
}
