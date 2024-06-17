<?php

namespace KeapGeek\Keap\Mock\Services;

use Carbon\Carbon;
use KeapGeek\Keap\Exceptions\ValidationException;

class Note
{
    public function find(int $id)
    {
        return $this->fakeNote(['id' => $id]);
    }

    public function delete(int $id)
    {
        return true;
    }

    public function update(int $id, array $data)
    {
        return $this->fakeNote(['id' => $id] + $data);
    }

    public function replace(int $id, array $data)
    {
        return $this->fakeNote(['id' => $id] + $data);
    }

    public function create(array $data)
    {
        $types = ['Appointment', 'Call', 'Email', 'Fax', 'Letter', 'Other'];
        if (! in_array($data['type'], $types)) {
            throw new ValidationException('Type must be one of the following: '.implode(', ', $types));
        }

        return array_merge([
            'user_id' => 0,
            'type' => 'Appointment',
        ], $data);
    }

    public function model()
    {
        return [
            'custom_fields' => [],
            'optional_properties' => null,
        ];
    }

    protected function fakeNote(array $data)
    {
        return array_merge([
            'id' => fake()->randomNumber(3),
            'contact_id' => fake()->randomNumber(3),
            'date_created' => Carbon::now('UTC')->format('Y-m-d\TH:i:s\Z'),
            'body' => fake()->paragraph(),
            'title' => fake()->sentence(),
            'last_updated' => fake()->boolean(),
            'type' => 'Appointment',
            'last_updated_by' => 0,
            'user_id' => 0,
        ], $data);
    }
}
