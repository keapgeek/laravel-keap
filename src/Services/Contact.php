<?php

namespace KeapGeek\Keap\Services;

use Carbon\Carbon;
use KeapGeek\Keap\Exceptions\KeapException;

class Contact extends Service
{
    protected $uri = '/v1/contacts';

    public function list(array $data = [])
    {
        if(array_key_exists('since', $data)) {
            $data['since'] = Carbon::parse($data['since'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if(array_key_exists('until', $data)) {
            $data['until'] = Carbon::parse($data['until'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        $list = $this->client->get('/');
        return $list['contacts'];
    }

    public function count(array $data = [])
    {
        if(array_key_exists('since', $data)) {
            $data['since'] = Carbon::parse($data['since'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        if(array_key_exists('until', $data)) {
            $data['until'] = Carbon::parse($data['until'])->setTimezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
        }

        $list = $this->client->get('/');
        return $list['count'];
    }

    public function find(int $contact_id, array $optional_properties = [])
    {
        return $this->client->get("/$contact_id", [
            'optional_properties' => implode(',', $optional_properties)
        ]);
    }


    public function create(array $data)
    {
        if (! array_key_exists('email_addresses', $data) && ! array_key_exists('phone_numbers', $data)) {
            throw new KeapException('Missing Email addresses and/or phone numbers');
        }

        $data['opt_in_reason'] = config('keap.opt_in_reason');

        return $this->client->post('/', $data);

    }

    public function createOrUpdate(array $data, $duplicate_option = 'Email')
    {
        if (! array_key_exists('email_addresses', $data) && ! array_key_exists('phone_numbers', $data)) {
            throw new KeapException('Missing Email addresses and/or phone numbers');
        }

        $data['duplicate_option'] = $duplicate_option;
        $data['opt_in_reason'] = config('keap.opt_in_reason');

        return $this->client->put('/', $data);

    }

    public function emails(int $contact_id, array $data = [])
    {
        $list = $this->client->get("/$contact_id/emails", $data);
        return $list['emails'];
    }

    public function creditCards(int $contact_id)
    {
        return $this->client->get("/$contact_id/creditCards");
    }

    public function delete(int $id)
    {
        return $this->client->delete("/$id");
    }

    public function model()
    {
        return $this->client->get('/model');
    }

    public function insertUTM(int $contact_id, string $keap_source_id, ?array $utms = [])
    {
        return $this->client->post("/$contact_id/utm", [
            'keapSourceId' => $keap_source_id,
        ] + $utms);
    }
}
