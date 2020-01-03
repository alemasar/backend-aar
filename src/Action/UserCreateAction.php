<?php

namespace App\Action;

use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Service\UserCreator;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UserCreateAction
{
    private $userCreator;

    public function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();
        $now = date('Y-m-d H:i:s', time());
        // Mapping (should be done in a mapper class)
        $user = new UserCreateData();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->created_at = $now;
        $user->updated_at = $now;
        $user->password = hash('gost', $data['password'].$user->name.$user->created_at);
        $user->role = $data['role'];
        
        // Invoke the Domain with inputs and retain the result
        $userId = $this->userCreator->createUser($user);
        // Transform the result into the JSON representation
        $result = [
            'user_id' => $userId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}