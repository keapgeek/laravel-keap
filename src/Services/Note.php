<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Exceptions\ValidationException;

class Note extends Service
{
    protected $uri = '/v1/notes';

    public function create(
        int $contact_id,
        ?string $title = null,
        ?string $body = null,
        ?string $type = 'Appointment',
        ?int $user_id = null,
    ){
        $types = ['Appointment', 'Call', 'Email', 'Fax', 'Letter', 'Other'];
        if(!in_array($type, $types)) {
            throw new ValidationException('Type must be one of the following: '. implode(', ', $types));
        }

            return $this->client->post('/', [
            'contact_id' => $contact_id,
            'title' => $title,
            'body' => $body,
            'type' => $type,
            'user' => $user_id,
        ]);
    }
    public function model()
    {
        return $this->client->get('/model');
    }
}
