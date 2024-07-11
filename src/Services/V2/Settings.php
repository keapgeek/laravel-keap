<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Services\Service;

class Settings extends Service
{
    protected $uri = '/v2/settings/';

    public function contactOptionTypes()
    {
        $types = $this->get('/contactOptionTypes');

        return $types['option_types'];
    }

    public function status()
    {
        return (bool) $this->get('/applications:isEnabled')['enabled'];
    }

    public function config(array $items = [])
    {
        return $this->get('/applications:getConfiguration', $items);
    }
}
