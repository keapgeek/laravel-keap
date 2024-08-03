<?php

// config for KeapGeek/Keap
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
     * Retries setting. When doing HTTP requests, these settings decide, in case of Status Code 500>,
     * the requested will automatically retry for a given amount of times and after a given delay in ms.
     */
    'retry_times' => 5,
    'retry_delay' => 50,

    /**
     * The middleware that protects the keap/auth and callback routes.
     */
    'middleware' => ['web'],

    /**
     * The duration in SECONDS for the get requests
     */
    'cache_duration' => 300,

    /**
     * When not specified, the achieve goal is going to call this default integration
     */
    'default_integration' => 'Laravel App',

    /**
     * This configuration apply to the submit form service.
     * The app name is the XXX### code of your application, if set to null, no form will be submitted.
     */
    'app_name' => null,

    /**
     * Opt In Reason
     * Needed to have marketable emails in Keap. It is a personalizable string field.
     */
    'opt_in_reason' => 'Opted In via App Webform.',

];
