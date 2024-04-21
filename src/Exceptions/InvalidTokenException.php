<?php

namespace Azzarip\Keap\Exceptions;

use App\Models\User;
use Azzarip\Keap\Notifications\KeapLogoutNotification;

class InvalidTokenException extends KeapException
{
    public function report(): void
    {
        User::find(config('keap.logout.user'))->notify(new KeapLogoutNotification);
    }
}
