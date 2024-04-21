<?php

namespace Azzarip\Keap\Exceptions;

use Illuminate\Foundation\Auth\User;
use Azzarip\Keap\Notifications\KeapLogoutNotification;

class InvalidTokenException extends KeapException
{
    public function report(): void
    {
        User::find(config('keap.logout.user'))->notify(new KeapLogoutNotification);
    }
}
