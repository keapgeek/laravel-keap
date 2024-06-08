<?php

namespace KeapGeek\Keap\Mock\Services;

class Task
{
    public function model()
    {
        return [
            'custom_fields' => [],
            'optional_properties' => null,
        ];
    }
    public function list(array $data = [])
    {
        $list = array_map(function () {
            return $this->fakeTask();
        }, range(1, 10));
        return ['tasks' => $list];
    }
    public function count(array $data = [])
    {
        return 10;
    }

    public function update(int $task_id, array $data) {
        return $this->fakeTask(['id' => $task_id] + $data);
    }

    public function replace(int $task_id, array $data) {
        return $this->fakeTask(['id' => $task_id] + $data);
    }

    public function find(int $id)
    {
        return $this->fakeTask(['id' => $id]);
    }
    public function delete(int $id)
    {
        return true;
    }

    protected function fakeTask(array $data = []){
        return array_merge([
            'id' => fake()->randomNumber(3),
            'completed' => fake()->boolean,
            "contact" => [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'id' => fake()->randomNumber(3),
                'email' => fake()->email(),
            ],
            "creation_date" => now()->subWeek(),
            "description" => fake()->paragraph(),
            "due_date" => now()->subDay(),
            "funnel_id" => 0,
            "jgraph_id" => 0,
            "modification_date" => now(),
            "priority" => 0,
            "remind_time" =>60,
            "title" => fake()->sentence(),
            "type" => null,
            "url" => fake()->url(),
            "user_id" => fake()->randomNumber(2)
            ], $data);
    }
}
