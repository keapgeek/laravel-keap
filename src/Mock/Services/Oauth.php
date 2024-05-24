<?php

namespace KeapGeek\Keap\Mock\Services;

class Oauth
{
    public function user()
    {
        return [
            'sub' => (string) fake()->id(),
            'email' => fake()->email(),
            'given_name' => fake()->firstName(),
            'family_name' => fake()->lastName(),
            'middle_name' => null,
            'global_user_id' => fake()->id(),
            'infusionsoft_id' => fake()->email(),
            'preferred_name' => null,
            'is_admin' => true,
        ];
    }

}
