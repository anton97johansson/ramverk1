<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class JsonIpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
     private $model;



     /**
      * The initialize method is optional and will always be called before the
      * target method/action. This is a convienient method where you could
      * setup internal properties that are commonly used by several methods.
      *
      * @return void
      */
    public function initialize() : void
    {
         // Use to initialise member variables.
         $this->model = new IpModel();
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        $title = "IP JSON";
        $page = $this->di->get("page");

        $page->add("ip/json_forms");
        return $page->render([
            "title" => $title,
        ]);
    }

    public function jsonlocationAction() : object
    {
        $title = "IP JSON MED LOCAtiON";
        $page = $this->di->get("page");

        $page->add("ip/json_location_forms");
        return $page->render([
            "title" => $title,
        ]);
    }

    public function jsonAction() : array
    {
        $request = $this->di->get("request");
        $ipAddress = $request->getGet("ip") ?? null;
        $data = [];
        if ($ipAddress !== null) {
            $data = $this->model->ipValidate($ipAddress);
        }
        return [$data];
    }

    public function jsonMapAction() : array
    {
        // $page = $this->di->get("page");
        $request = $this->di->get("request");
        $ipAddress = $request->getGet("ip") ?? null;
        // $ipAddress = strval($ipAddress);
        $data = [];
        if ($ipAddress !== null) {
            $data = $this->model->ipStack($ipAddress);
        }
        return [$data];
    }
}
