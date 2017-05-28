<?php

namespace Transformatika\Home\Test;

use Transformatika\Home\Model\HelloWorld;

class HelloWorldModelTest extends \PHPUnit_Framework_TestCase
{
    public function testGetHelloWorld()
    {
        $helloWorld = new HelloWorld();
        $this->assertEquals('Hello World', $helloWorld->getHelloWorld());
    }
}
