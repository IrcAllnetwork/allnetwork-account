<?php
return [
    [
        "path" => "/signin",
        "method" => "POST",
        "controller" => "Transformatika\Account\Controller\AccountController#signinAction"
    ],
    [
        "path" => "/my-account",
        "method" => "GET",
        "controller" => "Transformatika\Account\Controller\MyAccountController#indexAction"
    ],
    [
        "path" => "/my-account/settings",
        "method" => "GET",
        "controller" => "Transformatika\Account\Controller\MyAccountController#settingsPageAction"
    ],
    [
        "path" => "/signout",
        "method" => "GET",
        "controller" => "Transformatika\Account\Controller\MyAccountController#signoutAction"
    ]
];
