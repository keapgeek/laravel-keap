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

    /**
     * Retries setting. When doing HTTP requests, these settings decide, in case of Status Code 500>,
     * the requested will automatically retry for a given amount of times and after a given delay in ms.
     */
    'retry_times' => 5,
    'retry_delay' => 50,
];
