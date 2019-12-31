<?php

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\App;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;

return function (App $app) {
    // Define Custom Error Handler
    $customErrorHandler = function (
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails
    ) use ($app) {
        $payload = ['error' => $exception->getMessage()];

        $response = $app->getResponseFactory()->createResponse();
        $response->getBody()->write(
            json_encode($payload, JSON_UNESCAPED_UNICODE)
        );

        return $response->withStatus($exception->getCode());
    };

    // Add Error Middleware
    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorMiddleware->setDefaultErrorHandler($customErrorHandler);

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
    $app->map(["OPTIONS", "POST"],'/users', \App\Action\UserCreateAction::class)->add(\App\Middleware\JwtMiddleware::class);
    $app->map(["OPTIONS", "POST"], '/api/tokens', \App\Action\TokenCreateAction::class);
};
