<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\KeapException;

class Contact extends Service
{
    protected $uri = '/v1/contacts';

    public function list(array $data = [])
    {
        $this->parseDatetime('since', $data);
        $this->parseDatetime('until', $data);

        $list = $this->get('/');

        return $list['contacts'];
    }

    public function count(array $data = [])
    {
        $this->parseDatetime('since', $data);
        $this->parseDatetime('until', $data);

        $list = $this->get('/');

        return $list['count'];
    }

    public function find(int $contact_id, array $optional_properties = [])
    {
        if (empty($optional_properties)) {
            return $this->get("/$contact_id");
        }

        return $this->get("/$contact_id", [
            'optional_properties' => implode(',', $optional_properties),
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

        if (array_key_exists('company_id', $data)) {
            $data['company'] = ['id' => $data['company_id']];
            unset($data['company_id']);
        }

        $this->parseDatetime('anniversary', $data);
        $this->parseDatetime('birthday', $data);

        if (! array_key_exists('opt_in_reason', $data)) {
            $data['opt_in_reason'] = config('keap.opt_in_reason');
        }

        return $this->post('/', $data);

    }

    public function createOrUpdate(array $data, $duplicate_option = 'Email')
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

        if (array_key_exists('company_id', $data)) {
            $data['company'] = ['id' => $data['company_id']];
            unset($data['company_id']);
        }
        $this->parseDatetime('anniversary', $data);
        $this->parseDatetime('birthday', $data);

        if (! array_key_exists('duplicate_option', $data)) {
            $data['duplicate_option'] = $duplicate_option;
        }

        if (! array_key_exists('opt_in_reason', $data)) {
            $data['opt_in_reason'] = config('keap.opt_in_reason');
        }

        return $this->put('/', $data);
    }

    public function update(int $contact_id, array $data)
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

        $this->parseDatetime('anniversary', $data);
        $this->parseDatetime('birthday', $data);

        if (! array_key_exists('opt_in_reason', $data)) {
            $data['opt_in_reason'] = config('keap.opt_in_reason');
        }

        return $this->patch("/$contact_id", $data);
    }

    public function emails(int $contact_id, array $data = [])
    {
        $list = $this->get("/$contact_id/emails", $data);

        return $list['emails'];
    }

    public function createEmail(int $contact_id, array $data)
    {
        return $this->post("/$contact_id/emails", $data);
    }

    public function createCreditCard(int $contact_id, array $data)
    {
        return $this->post("/$contact_id/creditCards", $data);
    }

    public function listCreditCards(int $contact_id)
    {
        return $this->get("/$contact_id/creditCards");
    }

    public function delete(int $id)
    {
        return $this->del("/$id");
    }

    public function model()
    {
        return $this->get('/model');
    }

    public function tags(int $contact_id, array $data = [])
    {
        $list = $this->get("/$contact_id/tags", $data);

        return $list['tags'];
    }

    public function tag(int $contact_id, array $tag_ids)
    {
        return $this->post("/$contact_id/tags", [
            'tagIds' => $tag_ids,
        ]);
    }

    public function removeTag(int $contact_id, int $tag_id)
    {
        return $this->del("/$contact_id/tags/$tag_id");
    }

    public function removeTags(int $contact_id, array $tag_ids)
    {
        return $this->del("/$contact_id/tags?ids=".implode('%2C', $tag_ids));
    }

    public function insertUTM(int $contact_id, string $keap_source_id, ?array $utms = [])
    {
        return $this->post("/$contact_id/utm", [
            'keapSourceId' => $keap_source_id,
        ] + $utms);
    }
}
