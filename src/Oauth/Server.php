<?php
namespace Oauth;

class Server
{
    public $server;

    public function __construct()
    {
        $storage = new Storage();
        // Pass a storage object or array of storage objects to the OAuth2 server class
        $server = new \OAuth2\Server($storage, array(
            'allow_implicit' => true,
            ));

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        $server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));

        // Add the "Authorization Code" grant type (this is where the oauth magic happens)
        $server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));

        $server->addGrantType(new \OAuth2\GrantType\RefreshToken($storage, array(
            'always_issue_new_refresh_token' => false
        )));

        $defaultScope = 'basic';
        $supportedScopes = array(
          'basic',
          'accessbilling'
        );
        $memory = new \OAuth2\Storage\Memory(array(
          'default_scope' => $defaultScope,
          'supported_scopes' => $supportedScopes
        ));
        $scopeUtil = new \OAuth2\Scope($memory);

        $server->setScopeUtil($scopeUtil);
        $server->setConfig('enforce_state', false);
        $this->server = $server;
        return $this;
    }
}
