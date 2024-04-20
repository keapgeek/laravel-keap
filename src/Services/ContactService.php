<?php

namespace Azzarip\Keap\Services;

use Azzarip\Keap\Client;
use Illuminate\Support\Facades\Cache;

class ContactService
{
    protected $client;
    public function __construct()
    {
        $this->client = new Client('/v1/contacts');
    }


    public function list()
    {
        return $this->client->get('');
    }

}
