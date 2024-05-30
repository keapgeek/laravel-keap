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
        if($categoryId){
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
        ];;
    }

}
