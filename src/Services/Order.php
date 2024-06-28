<?php

namespace KeapGeek\Keap\Services;

use Illuminate\Support\Carbon;

class Order extends Service
{
    protected $uri = '/v1/orders';

    public function list(array $data = [])
    {

        if (array_key_exists('since', $data)) {
            $data['since'] = Carbon::parse($data['since'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('until', $data)) {
            $data['until'] = Carbon::parse($data['until'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        $list = $this->client->get('/', $data);

        return $list['orders'];
    }

    public function count(array $data = [])
    {

        if (array_key_exists('since', $data)) {
            $data['since'] = Carbon::parse($data['since'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if (array_key_exists('until', $data)) {
            $data['until'] = Carbon::parse($data['until'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

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
}
