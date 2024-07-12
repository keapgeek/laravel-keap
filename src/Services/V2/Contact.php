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

    public function list(array $data = [])
    {
        $this->parseFilter($data);

        return $this->get('/', $data);
    }

    public function update(int $contact_id, array $data)
    {
        return $this->patch("/$contact_id", $data);
    }

    public function paymentMethods(int $contact_id)
    {
        $response = $this->get("/$contact_id/paymentMethods");

        return $response['records'];
    }

    public function listLinkTypes(array $data = [])
    {
        if (array_key_exists('name', $data)) {
            $data['filter'] = 'name%3D%3D'.$data['name'];
            unset($data['name']);
        }
        $list = $this->get('/links/types', $data);

        return $list['contact_link_types'];
    }

    public function createLinkType(string $name, int $max_links = 0)
    {
        return $this->post('/links/types', [
            'max_links' => $max_links,
            'name' => $name,
        ]);
    }

    public function listLinkedContacts(int $contact_id)
    {
        $list = $this->get("/$contact_id/links");

        return $list['links'];
    }

    public function link(int $contact1_id, int $contact2_id, int $link_type_id)
    {
        return $this->post(':link', [
            'contact1_id' => $contact1_id,
            'contact2_id' => $contact2_id,
            'link_type_id' => $link_type_id,
        ]);
    }

    public function unlink(int $contact1_id, int $contact2_id, int $link_type_id)
    {
        return $this->post(':unlink', [
            'contact1_id' => $contact1_id,
            'contact2_id' => $contact2_id,
            'link_type_id' => $link_type_id,
        ]);
    }
}
