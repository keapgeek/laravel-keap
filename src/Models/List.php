<?php

namespace KeapGeek\Keap\Models;

use KeapGeek\Keap\Services\Service;

class List {
    public array $items;

    public int $count;

    protected string $sync_token;

    public function __construct(array $data, public Service $service)
    {
        $this->count = $data['count'];
        unset($data['count']);

        if (array_key_exists('sync_token', $data)) {
            $this->sync_token = $data['sync_token'];
            unset($data['sync_token']);
        }

        $previousUrl = $data['previous'];


    }


}
