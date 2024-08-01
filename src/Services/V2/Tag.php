<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Tag extends Service
{
    protected $uri = '/v2/tags';

    public function list(array $data = [])
    {
        if (array_key_exists('name', $data)) {
            $data['filter'] = 'name==' . $data['name'] . ';';
            unset($data['name']);
        }

        if (array_key_exists('description', $data)) {
            $data['filter'] = 'description==' . $data['description'] . ';';
            unset($data['description']);
        }

        $list = $this->get('/', $data);

        return $list['tags'];
    }

    public function delete(int $tag_id)
    {
        return $this->del("/$tag_id");
    }

    public function update(int $tag_id, array $data)
    {
        $this->switch('category_id', 'category', $data);

        return $this->patch("/$tag_id", $data);
    }

    public function create(array $data)
    {
        $this->switch('category_id', 'category', $data);

        return $this->post('/', $data);
    }

    public function find(int $tag_id)
    {
        return $this->get("/$tag_id");
    }

    public function listCategories(array $data = [])
    {
        $list = $this->get('/categories', $data);

        return $list['tag_categories'];
    }

    public function deleteCategory(int $category_id)
    {
        return $this->del("/categories/$category_id");
    }

    public function updateCategory(int $category_id, array $data)
    {
        return $this->patch("/categories/$category_id", $data);
    }

    public function createCategory(array $data)
    {
        return $this->post('/categories', $data);
    }

    public function findCategory(int $category_id)
    {
        return $this->get("/categories/$category_id");
    }

    public function listCompanies(int $tag_id, array $data = [])
    {
        return $this->get("/$tag_id/companies", $data);
    }

    public function listContacts(int $tag_id, array $data = [])
    {
        return $this->get("/$tag_id/contacts", $data);
    }

    public function apply(int $tag_id, int|array $ids)
    {
        if (is_int($ids)) {
            $ids = [$ids];
        }

        return $this->post("/$tag_id/contacts:applyTags", [
            'contact_ids' => $ids,
        ]);
    }

    public function remove(int $tag_id, int|array $ids)
    {
        if (is_int($ids)) {
            $ids = [$ids];
        }

        return $this->post("/$tag_id/contacts:removeTags", [
            'contact_ids' => $ids,
        ]);
    }
}
