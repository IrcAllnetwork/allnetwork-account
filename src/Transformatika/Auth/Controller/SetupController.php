<?php
namespace Transformatika\Auth\Controller;

use Transformatika\MVC\Controller;
use Transformatika\Config\Config;
use Propel\Runtime\Propel;

class SetupController extends Controller
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Propel::getConnection(\Propel\Table\Oauth\Map\ClientsTableMap::DATABASE_NAME);
    }
    public function index()
    {
        $rootDir = Config::getRootDir();
        $sqlFile = $rootDir.DS.'storage'.DS.'share'.DS.'setup.sql';
        $sqlScript = file_get_contents($sqlFile);
        $sqlQuery = $this->db->exec($sqlScript);
    }
}
