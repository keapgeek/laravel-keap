<?php

use function Pest\Laravel\get;

it('redirects to Auth Server with Parameters', function() {
    $url = 'https://accounts.infusionsoft.com/app/oauth/authorize?client_id=0123456789&redirect_uri=http://localhost/keap/callback&response_type=code&scope=full';

    get('/keap/auth')->assertRedirect($url);
});
