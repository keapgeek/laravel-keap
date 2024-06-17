<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Interfaces\KeapInterface;
use KeapGeek\Keap\Jobs\AchieveGoal;

class Job
{
    public function contactGoal(KeapInterface $contact, string $callName)
    {
        return AchieveGoal::dispatchAfterResponse($contact, $callName);
    }
}
