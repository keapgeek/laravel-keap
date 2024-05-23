<?php

namespace KeapGeek\Keap\Jobs;

use KeapGeek\Keap\Interfaces\KeapInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AchieveGoal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private KeapInterface $contact, private string $callName)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->contact->achieveGoal($this->callName);
    }
}
