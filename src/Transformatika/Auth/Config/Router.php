<?php
return [
    [
        "path" => "/authorize",
        "method" => "GET",
        "controller" => "Transformatika\Auth\Controller\AuthController#authorize"
    ],
    [
        "path" => "/authorize-request",
        "method" => "GET|POST",
        "controller" => "Transformatika\Auth\Controller\AuthController#authorizeRequest"
    ],
    [
        "path" => "/token",
        "method" => "POST",
        "controller" => "Transformatika\Auth\Controller\AuthController#token"
    ],
    [
        "path" => "/resource",
        "method" => "GET",
        "controller" => "Transformatika\Auth\Controller\AuthController#resource"
    ]
];
