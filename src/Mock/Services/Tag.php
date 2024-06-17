<?php

namespace KeapGeek\Keap\Mock\Services;

class Tag
{
    public function createCategory(string $name, string $description = '')
    {
        return [
            'id' => fake()->randomNumber(2),
            'name' => $name,
            'description' => $description,
        ];
    }

    public function create(string $name, string $description = '', ?int $categoryId = null)
    {
        if ($categoryId) {
            $category = [
                'id' => $categoryId,
                'name' => fake()->slug(),
                'description' => fake()->text(200),
            ];
        }

        return [
            'id' => fake()->randomNumber(2),
            'name' => $name,
            'description' => $description,
            'category' => $category ?? null,
        ];
    }

    public function find(int $tag_id)
    {
        return $this->fakeTag(['id' => $tag_id]);
    }

    public function applyToContacts(int $tag_id, array $contact_ids)
    {
        return array_map(function ($item) {
            return 'SUCCESS';
        }, $contact_ids);
    }

    public function removeFromContacts(int $tag_id, array $contact_ids)
    {
        return true;
    }

    public function removeFromContact(int $tag_id, int $contact_id)
    {
        return true;
    }

    protected function fakeTag(array $data)
    {
        return array_merge([
            'id' => fake()->randomNumber(2),
            'name' => fake()->word(),
            'description' => fake()->sentence,
            'category' => null,
        ], $data);
    }
}
