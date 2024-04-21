<?php

use Azzarip\Keap\Facades\Keap;
use Azzarip\Keap\Jobs\AchieveGoal;
use Azzarip\Keap\Services\Job;
use Azzarip\Keap\Tests\Classes\Contact;
use Illuminate\Support\Facades\Bus;

it('returns Job Service instance', function () {
    expect(Keap::job())->toBeInstanceOf(Job::class);
});

it('dispatches after response achieve goal', function () {
    Bus::fake();
    $contact = Contact::create(['name' => '::name::', 'email' => 'email@example.com']);

    Keap::job()->contactGoal($contact, 'test_call');
    Bus::assertDispatchedAfterResponse(AchieveGoal::class);
});
