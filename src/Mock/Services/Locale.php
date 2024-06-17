<?php

namespace KeapGeek\Keap\Mock\Services;

class Locale
{
    public function countries()
    {
        return [
            'USA' => 'United States',
        ];
    }

    public function provinces(string $country_code)
    {
        return [
            'US-AL' => 'Alabama'
        ];
    }

    public function dropdown(string $type)
    {
        return [
            0 => "Work",
            1 => "Home",
            3 => "Other",
        ];
    }
}
