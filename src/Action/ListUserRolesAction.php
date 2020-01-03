<?php

namespace App\Action;

use App\Domain\User\Data\UserRolesData;
use App\Domain\User\Service\ListUserRoles;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ListUserRolesAction
{
    private $listUserRoles;

    public function __construct(ListUserRoles $listUserRoles)
    {
        $this->listUserRoles = $listUserRoles;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Invoke the Domain with inputs and retain the result
        $roles = $this->listUserRoles->getRoles();
        return $response->withJson($roles->toArray())->withStatus(201);
    }
}