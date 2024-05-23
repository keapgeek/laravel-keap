<?php

namespace KeapGeek\Keap\Services;

use KeapGeek\Keap\Jobs\AchieveGoal;
use KeapGeek\Keap\Interfaces\KeapInterface;

class Job
{
    public function contactGoal(KeapInterface $contact, string $callName)
    {
        return AchieveGoal::dispatchAfterResponse($contact, $callName);
    }
}
