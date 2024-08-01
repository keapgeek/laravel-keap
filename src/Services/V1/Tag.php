<?php

namespace KeapGeek\Keap\Services\V1;

use KeapGeek\Keap\Services\Service;

class Tag extends Service
{
    protected $uri = '/v1/tags';

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['tags'];
    }

    public function count(array $data = [])
    {
        $list = $this->get('/', $data);

        return (int) $list['count'];
    }

    public function create(string | array $data, string $description = '', ?int $categoryId = null)
    {
        if(is_string($data)) {
            $category = $categoryId ? ['id' => $categoryId] : null;
            $data = [
                'name' => $data,
                'description' => $description,
                'category' => $category,
            ];
            trigger_error('The create method is with name and description is deprecated. Use the array form.', E_USER_DEPRECATED);
        }

        $this->switch('category_id', 'category', $data);

        return $this->post('/', $data);
    }

    public function createCategory(string | array $data, string $description = '')
    {
        if(is_string($data)) {
            $data = [
            'name' => $data,
            'description' => $description,
            ];
            trigger_error('The createCategory method is with name and description is deprecated. Use the array form.', E_USER_DEPRECATED);
        }
        return $this->post('/categories', $data);
    }

    public function find(int $tag_id)
    {
        return $this->get("/$tag_id");
    }

    public function applyToContacts(int $tag_id, array $contact_ids)
    {
        return $this->post("/$tag_id/contacts", [
            'ids' => $contact_ids,
        ]);
    }

    public function removeFromContacts(int $tag_id, array $contact_ids)
    {
        return $this->del("/$tag_id/contacts?ids=".implode(',', $contact_ids));
    }

    public function removeFromContact(int $tag_id, int $contact_id)
    {
        return $this->del("/$tag_id/contacts/$contact_id");
    }

    public function listCompanies(int $tag_id, array $data = [])
    {
        $list = $this->get("/$tag_id/companies", $data);

        return $list['companies'];
    }

    public function listContacts(int $tag_id, array $data = [])
    {
        $list = $this->get("/$tag_id/contacts", $data);

        return $list['contacts'];
    }
}
