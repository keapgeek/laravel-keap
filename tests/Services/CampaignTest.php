<?php

use Azzarip\Keap\Services\Campaign;

it('returns correct url for achieve goal', function () {
    $c = new Campaign();
    dd($c->achieve(1, 'paco', 'ricci'));
});
