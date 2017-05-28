<?php
namespace Transformatika\Account\Model;

use Zend\Diactoros\ServerRequest;
use Propel\Table\Account\Account;
use Propel\Table\Account\AccountQuery;
use Transformatika\Utility\Str;
use Transformatika\Message\Message;
use Transformatika\Message\MessageConstant;
use Transformatika\Config\Config;
use Zend\Crypt\Password\Bcrypt;
use Propel\Runtime\ActiveQuery\Criteria;
use Zend\Session\Container;
use PhpXmlRpc\Value;
use PhpXmlRpc\Request;
use PhpXmlRpc\Client;
use PhpXmlRpc\Encoder;

class AuthenticationModel
{
    protected $user;

    protected $status = [
        'n' => 'Not Active',
        'b' => 'Banned',
        'p' => 'Pending Activation',
        'r' => 'Expired',
        'd' => 'Deleted'
    ];

    public function __construct()
    {
        $this->user = new Container('user');
    }

    /**
     * Proses Sign in
     * @param  ServerRequest $request [description]
     * @return [type]                 [description]
     */
    public function signIn(ServerRequest $request)
    {
        $msg = new Message();
        $postData = $request->getParsedBody();
        $serviceURL = Config::getConfig('serviceURL');
        $client = new Client($serviceURL);
        $user = $postData['nick'];
        $pass = $postData['password'];
        $params = new Value(array(
            "username" => new Value($user, "string"),
            "password" => new Value($pass, "string")
          ), "struct");
        $response = $client->send(new Request('atheme.login', $params));
        if ($response->faultCode()) {
            return [
                'error' => 'Invalid NickName or Password!',
                'records' => []
            ];
        }

        $encoder = new Encoder();
        $session = $encoder->decode($response->value());
        // GET USER DETAIL
        $params = new Value(array(
            "session" => new Value($session, "string"),
            "username" => new Value($user, "string"),
            "password" => new Value($pass, "string"),
            "service" => new Value("NickServ", "string"),
            "command" => new Value("info", "string"),
            "param" => new Value($user, "string")
          ), "struct");
        $infoResponse = $client->send(new Request('atheme.command', $params));
        $nickInfo = $encoder->decode($infoResponse->value());
        // GET EMAIL ADDRESS
        $pattern = '/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i';
        preg_match_all($pattern, $nickInfo, $matches);
        foreach ($matches[0] as $k => $v) {
            if (filter_var($v, FILTER_VALIDATE_EMAIL)) {
                $nickEmail = $v;
            }
        }

        // GET REGISTER DATE
        $info = explode("\n", trim($nickInfo));
        $registerDate = explode(": ", $info[1]);
        $regDate = date('Y-m-d H:i:s', strtotime(preg_replace('/\([^)]+\)/', '', $registerDate[1])));

        $account = AccountQuery::create()->filterByUserName($user)
                                         ->filterByStatus('d', Criteria::NOT_EQUAL)
                                         ->findOne();

        if (empty($account)) {
            $str = new Str();
            $bcrypt = new Bcrypt();
            $newAccount = new Account();
            $newAccount->setId($str->getId());
            $newAccount->setUserName($user);
            $newAccount->setEmail($nickEmail);
            $newAccount->setRegisterDate($regDate);
            $newAccount->setPassword($bcrypt->create($pass));
            $newAccount->setStatus('y');
            $newAccount->setKey(null);
            $newAccount->save();

            $userData = $newAccount->toArray();
            $this->user->id = $userData['Id'];
            $this->user->email = $userData['Email'];
            $this->user->type = $userData['Type'];
            $this->user->firstName = $userData['FirstName'];
            $this->user->lastName = $userData['LastName'];

            return [
                'error' => null,
                'msg' => 'Welcome to AllNetwork',
                'records' => [
                    'id' => $userData['Id'],
                    'email' => $userData['Email'],
                    'firstName' => $userData['FirstName'],
                    'lastName' => $userData['LastName'],
                    'type' => $userData['Type'],
                    'avatar' => $userData['Avatar'],
                    'ref' => $postData['ref'],
                    'refPath' => $postData['refPath']
                ]
            ];
        }
        /**
         * Pastikan account ada di database
         */
        if ($account !== null) {
            /**
             * Pastikan akun telah aktif
             */
            if ($account->getStatus() !== 'y') {
                return [
                    'error' => 'ERR_ACCOUNT_NOT_ACTIVE',
                    'msg' => $msg->getMessage(
                        MessageConstant::ERR_ACCOUNT_BLOCKED,
                        [
                            'reason' => $this->status[$account->getStatus()]
                        ]
                    )
                ];
            }

            /**
             * Pastikan akun tidak expired
             */
            // if ($account->getExpired('U') < time()) {
            //     return [
            //         'error' => 'ERR_ACCOUNT_EXPIRED',
            //         'msg' => $msg->getMessage(
            //             MessageConstant::ERR_ACCOUNT_EXPIRED,
            //             [
            //                 'name' => $postData['email'],
            //                 'date' => $account->getExpired('d/m/Y')
            //             ]
            //         )
            //     ];
            // }

            $userData = $account->toArray();
            $this->user->id = $userData['Id'];
            $this->user->email = $userData['Email'];
            $this->user->type = $userData['Type'];
            $this->user->firstName = $userData['FirstName'];
            $this->user->lastName = $userData['LastName'];

            return [
                'error' => null,
                'msg' => 'Welcome to The Web Platform',
                'records' => [
                    'id' => $userData['Id'],
                    'email' => $userData['Email'],
                    'firstName' => $userData['FirstName'],
                    'lastName' => $userData['LastName'],
                    'type' => $userData['Type'],
                    'avatar' => $userData['Avatar'],
                    'ref' => $postData['ref'],
                    'refPath' => $postData['refPath']
                ]
            ];
        }

        return [
            'error' => 'ERR_ACCOUNT_NOT_FOUND',
            'msg' => $msg->getMessage(
                MessageConstant::ERR_NOT_FOUND,
                ['name' => 'Account']
            ),
            'records' =>[]
        ];
    }
}
