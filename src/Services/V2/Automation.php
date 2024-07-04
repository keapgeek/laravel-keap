<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Automation extends Service
{
    protected $uri = '/v2/automations';

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);
        return $list['automations'];
    }

    public function count(array $data = [])
    {
        $list = $this->get('/', $data);
        return $list['automation_count'];
    }

    public function delete(int|array $id)
    {
        if(is_int($id)){
            $id = [$id];
        }

        return $this->del('/', [
            'automation_ids' => $id
        ]);
    }

    public function updateCategory(int|array $automation_ids, int|array $category_ids, bool $apply_category = true)
    {
        if(is_int($automation_ids)){
            $automation_ids = [$automation_ids];
        }

        if(is_int($category_ids)){
            $category_ids = [$category_ids];
        }


        return $this->put('/category', [
            'apply_category' => $apply_category,
            'automation_ids' => $automation_ids,
            'category_ids' => $category_ids,
        ]);
    }

    public function find(int $automation_ids)
    {
        return $this->get("/$automation_ids");
    }
}
