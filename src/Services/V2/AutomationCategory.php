<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class AutomationCategory extends Service
{
    protected $uri = '/v2/automationCategory';

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['automation_categories'];
    }

    public function delete(int|array $id)
    {
        if (is_int($id)) {
            $id = [$id];
        }

        return $this->del('/', [
            'ids' => $id,
        ]);
    }

    public function update(int $category_id, string $category_name)
    {
        return $this->put('/', [
            'id' => $category_id ?? null,
            'name' => $category_name ?? null,
        ]);
    }

    public function create(string $category_name)
    {
        return $this->post('/', [
            'name' => $category_name,
        ]);
    }
}
