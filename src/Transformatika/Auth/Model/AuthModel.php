<?php
namespace Transformatika\Auth\Model;

class AuthModel
{
    protected $server;

    public function __construct()
    {
        $oauth = new \Oauth\Server();
        $this->server = $oauth->server;
    }

    /**
     * Verify Token
     * @param  string $scope [description]
     * @return [type]        [description]
     */
    public function verify($scope = '')
    {
        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();

        /**
         * Jika tidak membutuhkan scope maka hanya cek token saja
         */
        if (empty($scope)) {
            if (!$token = $server->grantAccessToken($request, $response)) {
                $response->send();
                die();
            }
            return true;
        }

        /**
         * verifikasi apakah scope valid
         */
        if (!$server->verifyResourceRequest($request, $response, $scope)) {
            $response->send();
            die();
        }
        return true;
    }

    /**
     * Untuk mendapatkan userId
     * Karena pada framework sebelumnya menggunakan nama getSub
     * maka disini juga tetap menggunakan nama getSub agar tidak membingungkan
     * tetap bisa digunakan
     *
     * @param  string $key [description]
     * @return [type]      [description]
     */
    public function getSub($key = 'userId')
    {
        $token = $server->getAccessTokenData(\OAuth2\Request::createFromGlobals());
        return $token[$key];
    }

    /**
     * Ini adalah alias untuk getSub
     * sebenarnya key bisa menggunakan parameter apa saja
     * tergantung pada Controller Auth nya
     *
     * @param  string $key [description]
     * @return [type]      [description]
     */
    public function getData($key = 'userId')
    {
        return $this->getSub($key);
    }
}
