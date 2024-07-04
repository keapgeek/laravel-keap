<?php

namespace KeapGeek\Keap\Services;

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

    public function create(string $name, string $description = '', ?int $categoryId = null)
    {
        $category = $categoryId ? ['id' => $categoryId] : null;

        return $this->post('/', [
            'name' => $name,
            'description' => $description,
            'category' => $category,
        ]);
    }

    public function createCategory(string $name, string $description = '')
    {
        return $this->post('/categories', [
            'name' => $name,
            'description' => $description,
        ]);
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

    public function taggedCompanies(int $tag_id, array $data = [])
    {
        $list = $this->get("/$tag_id/companies", $data);

        return $list['companies'];
    }

    public function taggedContacts(int $tag_id, array $data = [])
    {
        $list = $this->get("/$tag_id/contacts", $data);

        return $list['contacts'];
    }
}
