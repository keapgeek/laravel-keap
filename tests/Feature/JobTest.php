<?php

use Illuminate\Support\Facades\Bus;
use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Jobs\AchieveGoal;
use KeapGeek\Keap\Services\Job;
use KeapGeek\Keap\Tests\Classes\Contact;

it('returns Job Service instance', function () {
    expect(Keap::job())->toBeInstanceOf(Job::class);
});

it('dispatches after response achieve goal', function () {
    Bus::fake();
    $contact = Contact::create(['name' => '::name::', 'email' => 'email@example.com']);

    Keap::job()->contactGoal($contact, 'test_call');
    Bus::assertDispatchedAfterResponse(AchieveGoal::class);
});
