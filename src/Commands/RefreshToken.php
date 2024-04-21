<?php

namespace Azzarip\Keap\Commands;

use Azzarip\Keap\Exceptions\InvalidTokenException;
use Azzarip\Keap\Keap;
use Illuminate\Console\Command;

class RefreshToken extends Command
{
    public $signature = 'keap:refresh';

    public $description = 'Refresh Keap access and refresh tokens.';

    public function handle(): int
    {
        if (! Keap::token()->check()) {
            $this->error('Access and refresh tokens not found in cache. Please login at /keap/auth');
            throw new InvalidTokenException;
        }

        Keap::token()->refresh();

        $this->info('Successfully refreshed access and refresh tokens.');

        return self::SUCCESS;
    }
}
