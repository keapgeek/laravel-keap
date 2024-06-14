<?php

namespace KeapGeek\Keap\Mock\Services;

class Appointment
{
    public function list(array $data = [])
    {
        $list = array_map(function () {
            return $this->fakeAppointment();
        }, range(1, 10));
        return ['appointments' => $list];
    }
    public function count(array $data = [])
    {
        return 10;
    }
    public function model()
    {
        return [
            'custom_fields' => [],
            'optional_properties' => null,
        ];
    }

    public function delete(int $id)
    {
        return true;
    }

    public function update(int $appointment_id, array $data) {
        return $this->fakeAppointment(['id' => $appointment_id] + $data);
    }

    public function replace(int $appointment_id, array $data) {
        return $this->fakeAppointment(['id' => $appointment_id] + $data);
    }

    public function create(array $data){
        return $this->fakeAppointment($data);
    }


    protected function fakeAppointment($data = [])
    {
        return array_merge([
            'id' => fake()->randomNumber(3),
            "contact_id" => fake()->randomNumber(3),
            "description" => fake()->paragraph(),
            "end_date" => now()->subDay(),
            "start_date" => now()->subWeek(),
            "location" => null,
            "remind_time" =>60,
            "title" => fake()->sentence(),
            "user_id" => fake()->randomNumber(2)
            ], $data);
    }
}
