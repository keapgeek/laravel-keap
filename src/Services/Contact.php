<?php

namespace Azzarip\Keap\Services;

class Contact extends Service
{
    protected $uri = '/v1/contacts';

    public function list()
    {
        return $this->client->get('');
    }

}
