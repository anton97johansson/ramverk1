<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpControllerTest extends TestCase
{
    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $controller = new IpController();
        $controller->setDI($di);
        $controller->initialize();

        // Do the test and assert it
        $request = $di->get("request");
        $response = $di->get("response");
        $request->setGet("ipAdress", "44.125.111.240");
        $res = $controller->indexAction();
        $response->redirectSelf();
        $this->assertIsObject($res);
        $response->redirectSelf();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "index".
     */
    public function testFalseIndexAction()
    {
        global $di;
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $controller = new IpController();
        $controller->setDI($di);
        $controller->initialize();

        // Do the test and assert it
        $request = $di->get("request");
        $response = $di->get("response");
        // $request->setGet("ipAdress", "44.125.111.240");
        $request->setGet("ipAdress", "ad.wawd");
        // var_dump($request->getGet("ipAdress"));
        $res = $controller->indexAction();

        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        // $body = $request->getBody();
        // var_dump($body);
    }
    //
    //
    //
    // /**
    //  * Test the route "info".
    //  */
    // public function testInfoActionGet()
    // {
    //     $controller = new SampleController();
    //     $controller->initialize();
    //     $res = $controller->infoActionGet();
    //     $this->assertContains("db is active", $res);
    // }
    //
    //
    //
    // /**
    //  * Test the route "dump-di".
    //  */
    // public function testDumpDiActionGet()
    // {
    //     // Setup di
    //     $di = new DIFactoryConfig();
    //     $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
    //
    //     // Use a different cache dir for unit test
    //     $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
    //
    //     // Setup the controller
    //     $controller = new SampleController();
    //     $controller->setDI($di);
    //     $controller->initialize();
    //
    //     // Do the test and assert it
    //     $res = $controller->dumpDiActionGet();
    //     $this->assertContains("di contains", $res);
    //     $this->assertContains("configuration", $res);
    //     $this->assertContains("request", $res);
    //     $this->assertContains("response", $res);
    // }
}
