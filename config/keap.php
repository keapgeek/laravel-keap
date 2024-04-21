<?php

// config for Azzarip/Keap
return [
    /**
     * The Keap client KEY.
     */
    'client_key' => env('KEAP_CLIENT_KEY'),

    /**
     * The Keap client SECRET.
     */
    'client_secret' => env('KEAP_CLIENT_SECRET'),

    /**
     * When not specified, the achieve goal is going to call this default integration
     */
    'default_integration' => env('KEAP_DEFAULT_INTEGRATION'),
];
