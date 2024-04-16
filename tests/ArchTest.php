<?php

it('can test', function () {
    expect(true)->toBeTrue();
});

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->each->not->toBeUsed();
