<?php

namespace KeapGeek\Keap\Services\V1;

use KeapGeek\Keap\Services\Service;

class File extends Service
{
    protected $uri = '/v1/files';

    public function list(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['files'];
    }

    public function count(array $data = [])
    {
        $list = $this->get('/', $data);

        return $list['count'];
    }

    public function upload(string $file_name, $file_data, bool $is_public = false, ?int $contact_id = null)
    {
        $data = [
            'file_name' => $file_name,
            'file_data' => $file_data,
            'is_public' => $is_public,
            'file_association' => 'USER',
        ];
        if ($contact_id) {
            $data['file_association'] = 'CONTACT';
            $data['contact_id'] = $contact_id;
        }

        return $this->post('/', $data);
    }

    public function find(int $file_id, array $optional_properties = [])
    {
        if (empty($optional_properties)) {
            return $this->get("/$file_id");
        }

        return $this->get("/$file_id", [
            'optional_properties' => implode(',', $optional_properties),
        ]);
    }

    public function delete(int $file_id)
    {
        return $this->del("/$file_id");
    }

    public function replace(int $file_id, string $file_name, $file_data, bool $is_public = false, ?int $contact_id = null)
    {
        $data = [
            'file_name' => $file_name,
            'file_data' => $file_data,
            'is_public' => $is_public,
            'file_association' => 'USER',
        ];
        if ($contact_id) {
            $data['file_association'] = 'CONTACT';
            $data['contact_id'] = $contact_id;
        }
        $this->put("/$file_id", $data);
    }
}
