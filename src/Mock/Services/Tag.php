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

}
