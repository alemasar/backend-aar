<?php

namespace App\Action;

use App\Domain\User\Data\UserAuthData;
use App\Domain\User\Service\UserAuth;
use App\Auth\JwtAuth;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class TokenCreateAction
{
    private $jwtAuth;

    public function __construct(JwtAuth $jwtAuth, UserAuth $userAuth)
    {
        $this->jwtAuth = $jwtAuth;
        $this->userAuth = $userAuth;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $data = (array)$request->getParsedBody();

        $user = new UserAuthData();
        $user->email = $data['email'];
        $user->password = $data['password'];

        $checkUser = $this->userAuth->checkLogin($user);
        // Validate login (pseudo code)
        // Warning: This should be done in an application service and not here!
        // e.g. $isValidLogin = $this->userAuth->checkLogin($username, $password); 
        // Create a fresh token
        $token = $this->jwtAuth->createJwt($user->email);
        $lifetime = $this->jwtAuth->getLifetime();

        // Transform the result into a OAuh 2.0 Access Token Response
        // https://www.oauth.com/oauth2-servers/access-tokens/access-token-response/
        $result = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => $lifetime,
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}