<?php

namespace Azzarip\Keap\Models;

use Azzarip\Keap\Exceptions\KeapException;

class Contact
{
    public ?int $id;

    public ?array $addresses;

    public ?string $anniversary;

    public ?string $birthday;

    public ?string $contact_type;

    public ?array $custom_fields;

    public ?array $email_addresses;

    public ?string $family_name;

    public ?array $fax_numbers;

    public ?string $given_name;

    public ?string $job_title;

    public ?int $lead_source_id;

    public ?string $middle_name;

    public ?string $opt_in_reason;

    public ?int $owner_id;

    public ?array $phone_numbers;

    public ?string $preferred_locale;

    public ?string $preferred_name;

    public ?string $prefix;

    public ?array $social_accounts;

    public ?string $source_type;

    public ?string $spouse_name;

    public ?string $suffix;

    public ?string $time_zone;

    public ?string $website;

    public function isValid(): bool
    {
        if (empty($this->email_addresses) && empty($this->phone_numbers)) {
            return false;
        }

        return true;
    }

    public function validate()
    {
        if (! $this->isValid()) {
            throw new KeapException('Missing Email addresses and/or phone numbers');
        }
    }

    public static function load(array $data): self
    {
        $contact = new Contact();
        foreach ($data as $key => $value) {
            $contact->$key = $value;
        }

        return $contact;
    }
}
