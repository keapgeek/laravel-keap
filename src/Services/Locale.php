<?php

namespace KeapGeek\Keap\Services;

class Locale extends Service
{
    protected $uri = '/v1/locales';

    public function countries()
    {
        return $this->client->get('/countries')['countries'];
    }

    public function provinces(string $country_code)
    {
        return $this->client->get("/countries/$country_code/provinces")['provinces'];
    }

    public function dropdown(string $type)
    {
        return $this->client->get("/defaultOptions")[$type . '_types'];
    }
}
