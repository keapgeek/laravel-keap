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
    'middleware' => ['web', 'auth'],

    /**
     * The duration in SECONDS for the get requests
     */
    'cache_duration' => 300,

    /**
     * When not specified, the achieve goal is going to call this default integration
     */
    'default_integration' => env('KEAP_DEFAULT_INTEGRATION'),

    /**
     * This configuration apply to the submit form service.
     * The app name is the XXX### code of your application, if set to null, no form will be submitted.
     */
    'app_name' => null,

    /**
     * Contact Data
     * This array matches Keap contact attributes with your Contact Model attributes.
     * The key are keap attributes, the values your contact attributes.
     * KeapTrait must be included. All the other attributes can be found here
     *  https://developer.keap.com/docs/rest/#tag/Contact/operation/createOrUpdateContactUsingPUT
     */
    'contact_data' => [
        'email' => 'email',
        'given_name' => 'name',
        // include all other firles
    ],

    /**
     * Opt In Reason
     * Needed to have marketable emails in Keap. It is a personalizable string field.
     */
    'opt_in_reason' => 'Opted In via App Webform.',

    /**
     * Logout Notification
     * In case of expired token the following user
     */
    'logout' => [
        'user' => 1,
        'via' => ['mail'],
    ],
];
