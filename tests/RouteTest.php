<?php

use function Pest\Laravel\get;

it('redirects to Auth Server with Parameters', function() {
    $url = 'https://accounts.infusionsoft.com/app/oauth/authorize?client_id=0123456789&redirect_uri=http%3A%2F%2Flocalhost%2Fkeap%2Fcallback&response_type=code&scope=full';

    get('/keap/auth')->assertRedirect($url);
});
