<?php

namespace Azzarip\Keap\Services;

use Azzarip\Keap\Jobs\AchieveGoal;
use Azzarip\Keap\Interfaces\KeapInterface;

class Job
{
    public function contactGoal(KeapInterface $contact, string $callName)
    {
        return AchieveGoal::dispatchAfterResponse($contact, $callName);
    }
}
