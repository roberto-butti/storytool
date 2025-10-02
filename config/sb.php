<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Storyblok Personal Access Token
    |--------------------------------------------------------------------------
    |
    | A Personal Access Token (PAT) for Storyblok is an account-level token you
    | generate from your account settings to grant broad access to all spaces
    | associated with your Storyblok account, particularly for the Management
    | API.
    | It is not tied to a single space but to your user account.
    | You should never expose your PAT in frontend code or commit it to version
    | control, instead using secure methods like environment variables to store
    | it.
    |
    */

    'personal_access_token' => env('STORYBLOK_PERSONAL_ACCESS_TOKEN', ''),
];
