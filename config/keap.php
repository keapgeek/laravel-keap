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
];
