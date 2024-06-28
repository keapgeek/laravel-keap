<?php

namespace KeapGeek\Keap\Commands;

use Illuminate\Console\Command;
use KeapGeek\Keap\Exceptions\InvalidTokenException;
use KeapGeek\Keap\Token;

class RefreshToken extends Command
{
    public $signature = 'keap:refresh';

    public $description = 'Refresh Keap access and refresh tokens.';

    public function handle(): int
    {
        if (! Token::check()) {
            $this->error('Access and refresh tokens not found in cache. Please login at /keap/auth');
            (new InvalidTokenException)->report();

            return self::FAILURE;
        }

        Token::refresh();

        $this->info('Successfully refreshed access and refresh tokens.');

        return self::SUCCESS;
    }
}
