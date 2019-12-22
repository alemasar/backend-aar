<?php

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\App;

return function (App $app) {
    $app->add(new Tuupola\Middleware\CorsMiddleware);
    $app->add(new Tuupola\Middleware\CorsMiddleware([
        "origin" => ["*"],
        "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE", "OPTIONS"],
        "headers.allow" => ['', 'Authorization', 'Content-Type', 'Content-Length', 'Origin', 'Accept', "If-Match", "If-Unmodified-Since"],
        "headers.expose" => ["Etag"],
        "credentials" => true,
        "cache" => 86400
    ]));
    $app->get('/', \App\Action\HomeAction::class);
    $app->map(["OPTIONS", "POST"],'/users', \App\Action\UserCreateAction::class);
    $app->map(["OPTIONS", "POST"], '/api/tokens', \App\Action\TokenCreateAction::class);
};
