<?php

namespace Azzarip\Keap\Services;

use Azzarip\Keap\Jobs\AchieveGoal;

class Job
{
    public function contactGoal($contact, string $callName)
    {
        return AchieveGoal::dispatchAfterResponse($contact, $callName);
    }
}
