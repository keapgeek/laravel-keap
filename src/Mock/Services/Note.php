<?php

namespace KeapGeek\Keap\Mock\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Note
{
    public function create(
        int $contact_id,
        ?string $title = null,
        ?string $body = null,
        ?string $type = null,
        ?int $user_id = null,
    ){
        $types = ['Appointment', 'Call', 'Email', 'Fax', 'Letter', 'Other'];
        if(!in_array($type, $types)) {
            throw new ValidationException('Type must be one of the following: '. implode(', ', $types));
        }

        return [
            'body' => $body,
            'contact_id' => $contact_id,
            'title' => $title,
            'type' => $type ?? 'Appointement',
            'user_id' => $user_id ?? 0,
        ];
    }

    public function model()
    {
        return [
            'custom_fields' => [],
            'optional_properties' => null,
        ];
    }

}
