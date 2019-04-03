<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Namespace
    |--------------------------------------------------------------------------
    |
    | Set the namespace for the Responders.
    |
    */

    'namespace' => 'Http\\Responders',

    /*
    |--------------------------------------------------------------------------
    | Method Name
    |--------------------------------------------------------------------------
    |
    | Set the method name for the Responders.
    |
    */

    'method' => 'respond',

    /*
    |--------------------------------------------------------------------------
    | Syffix
    |--------------------------------------------------------------------------
    |
    | Set the syffix for the Responders.
    |
    */
    'suffix' => 'Responder',

    /*
    |--------------------------------------------------------------------------
    | Duplicate Suffixes
    |--------------------------------------------------------------------------
    |
    | If you have a responder suffix set in the config and try to generate a Responder that also includes the suffix,
    | the package will recognize this duplication and rename the Responder to remove the extra suffix.
    | This is the default behavior. To override and allow the duplication, change to false.
    |
     */
    'override_duplicate_suffix' => true,
];
