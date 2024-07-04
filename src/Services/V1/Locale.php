<?php

namespace KeapGeek\Keap\Services\V1;

use KeapGeek\Keap\Services\Service;

class Locale extends Service
{
    protected $uri = '/v1/locales';

    public function countries()
    {
        return $this->get('/countries')['countries'];
    }

    public function provinces(string $country_code)
    {
        return $this->get("/countries/$country_code/provinces")['provinces'];
    }

    public function dropdown(string $type)
    {
        return $this->get('/defaultOptions')[$type.'_types'];
    }
}
