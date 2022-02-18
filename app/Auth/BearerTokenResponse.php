<?php

namespace App\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;

class BearerTokenResponse extends \League\OAuth2\Server\ResponseTypes\BearerTokenResponse
{
    /**
     * Add custom fields to your Bearer Token response here, then override
     * AuthorizationServer::getResponseType() to pull in your version of
     * this class rather than the default.
     *
     * @param AccessTokenEntityInterface $accessToken
     *
     * @return array
     */
    protected function getExtraParams(AccessTokenEntityInterface $accessToken)
    {
        $user=User::findOrFail($accessToken->getUserIdentifier());
        $user->roles;
        return [
            "user"=> $user
        ];
    }
}
