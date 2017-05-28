<?php

namespace Transformatika\Home\Test;

use PHPUnit\Framework\TestCase;
use Transformatika\Home\Controller\HomeController;

class HomeControllerTest extends TestCase
{
    public function testIndex()
    {
        $home = new HomeController();
        $homeReturn = $home->index();
        $viewPath = $home->view->getViewPath();

        // Return must have key "template"
        $this->assertArrayHasKey('template', $homeReturn);
        // Check if template file is exists
        $this->assertFileExists($viewPath . DIRECTORY_SEPARATOR . $homeReturn['template']);
    }
}
