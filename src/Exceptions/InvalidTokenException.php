<?php

namespace KeapGeek\Keap\Exceptions;

use App\Models\User;
use KeapGeek\Keap\Notifications\KeapLogoutNotification;

class InvalidTokenException extends KeapException
{
    public function report(): void
    {
        User::find(config('keap.logout.user'))->notify(new KeapLogoutNotification);
    }
}
