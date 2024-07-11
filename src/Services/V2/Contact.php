<?php

namespace KeapGeek\Keap\Services\V2;

use KeapGeek\Keap\Exceptions\KeapException;
use KeapGeek\Keap\Services\Service;

class Contact extends Service
{
    protected $uri = '/v2/contacts';

    public function find(int $contact_id, array $fields = [])
    {
        if (empty($fields)) {
            return $this->get("/$contact_id");
        }

        return $this->get("/$contact_id", [
            'fields' => implode(',', $fields),
        ]);
    }

    public function create(array $data)
    {
        if (array_key_exists('email', $data)) {
            $data['email_addresses'] = [
                'email' => $data['email'],
                'fields' => 'EMAIL1',
            ];
            unset($data['email']);
        }
        if (! array_key_exists('email_addresses', $data) && ! array_key_exists('phone_numbers', $data)) {
            throw new KeapException('Missing Email addresses and/or phone numbers');
        }

        $this->switch('company_id', 'company', $data);

        $this->parseDatetime('anniversary_date', $data);
        $this->parseDatetime('birth_date', $data);

        if (! array_key_exists('opt_in_reason', $data)) {
            $data['opt_in_reason'] = config('keap.opt_in_reason');
        }

        return $this->post('/', $data);

    }

    public function delete(int $id)
    {
        return $this->del("/$id");
    }

    public function model()
    {
        return $this->get('/model');
    }
}
