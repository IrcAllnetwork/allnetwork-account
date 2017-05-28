<?php
namespace Transformatika\Session;

use Zend\Diactoros\ServerRequest;
use Transformatika\Config\Config;
use Zend\Session\Container;
use Zend\Diactoros\Response\RedirectResponse;

class SessionMiddleware
{
    protected $user;

    protected $matchTypes = [
        'i'  => '[0-9]++',
        'a'  => '[0-9A-Za-z]++',
        'h'  => '[0-9A-Fa-f]++',
        '*'  => '.+?',
        '**' => '.++',
        ''   => '[^/\.]++'
    ];

    protected $options = [];

    public function __construct()
    {
        $this->user = new Container('user');
        $this->options = Config::readConfigFile('rbac.yaml');
    }

    public function __invoke(ServerRequest $request)
    {
        $requestUrl = $request->getUri()->getPath();
        foreach ($this->options['whiteList'] as $k => $v) {
            if ($this->checkSession($v, $requestUrl)) {
                return true;
            }
        }
        if (!$this->user->id) {
            header('location:'.BASE_URL.'?ref='.rawurlencode($requestUrl.'?'.$request->getUri()->getQuery()));
            exit();
        }
        return true;
    }

    protected function checkSession($path, $requestUrl)
    {
        $regex = $this->generateRegex($path);
        if (preg_match($regex, $requestUrl) === 1) {
            return true;
        }

        return false;
    }

    protected function generateRegex($route)
    {
        if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {
            $matchTypes = $this->matchTypes;
            foreach ($matches as $match) {
                list($block, $pre, $type, $param, $optional) = $match;
                if (isset($matchTypes[$type])) {
                    $type = $matchTypes[$type];
                }
                if ($pre === '.') {
                    $pre = '\.';
                }
                //Older versions of PCRE require the 'P' in (?P<named>)
                $pattern = '(?:'
                        . ($pre !== '' ? $pre : null)
                        . '('
                        . ($param !== '' ? "?P<$param>" : null)
                        . $type
                        . '))'
                        . ($optional !== '' ? '?' : null);
                $route = str_replace($block, $pattern, $route);
            }
        }
        return "`^$route$`u";
    }
}
