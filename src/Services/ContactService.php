<?php

namespace Azzarip\Keap\Services;

use Azzarip\Keap\Client;

class ContactService extends Service
{
    protected $uri = '/v1/contacts';

    public function list()
    {
        return $this->client->get('');
    }

}
