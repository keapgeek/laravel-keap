<?php

namespace Azzarip\Keap\Commands;

use Illuminate\Console\Command;

class KeapCommand extends Command
{
    public $signature = 'laravel-keap';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
