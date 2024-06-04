<?php

use KeapGeek\Keap\Facades\Keap;
use KeapGeek\Keap\Tests\Classes\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('hasKeap return false on missing keap_id', function () {
    $this->contact = Contact::create(['name' => 'Test User', 'email' => 'test@user.com']);

    expect($this->contact->hasKeap())->toBeFalse();
});

test('hasKeap return true with keap_id', function () {
    $this->contact = Contact::create(['name' => 'Test User', 'email' => 'test@user.com', 'keap_id' => 1]);

    expect($this->contact->hasKeap())->toBeTrue();
});

test('achieveGoal creates a Keap Id', function () {
    $this->contact = Contact::create(['name' => 'Test User', 'email' => 'test@user.com']);

    Keap::fake();
    $this->contact->achieveGoal('test_goal');
    expect($this->contact->hasKeap())->toBeTrue();
})->throwsNoExceptions();
