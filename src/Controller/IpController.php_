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
class IpController implements ContainerInjectableInterface
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
        $page = $this->di->get("page");
        $title = "ip validator";
        $request = $this->di->get("request");
        $ipAddress = $request->getGet("ipAdress") ?? null;
        $hostname = null;
        $check = null;
        if ($ipAddress !== null) {
            if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) || filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                $check = $ipAddress . " is OK";
                $hostname = gethostbyaddr($ipAddress);
                if ($hostname == $ipAddress) {
                    $hostname = "Not found";
                }
            } else {
                $check = $ipAddress . " is NOT OK";
                $hostname = "Not found";
            }
        }
        $data = [
            "check" => $check,
            "hostname" => $hostname
        ];
        $page->add("ip/forms", $data);
        return $page->render([
            "title" => $title,
        ]);
    }

    public function mapAction() : object
    {
        $page = $this->di->get("page");
        $title = "ip validator with map";
        $request = $this->di->get("request");
        $ipAddress = $request->getGet("ipMap") ?? null;
        $version = null;
        $localIP = $this->model->local();
        $res = $this->model->ipStack($localIP);
        $lat = $res["latitude"];
        $long = $res["longitude"];
        $country = $res["country_name"];
        $region = $res["region_name"];
        $hostname = null;
        $check = null;
        if ($ipAddress !== null) {
            $response = $this->model->ipValidate($ipAddress);
            $check = $response[0];
            $hostname = $response[1];
            $version = $response[2];
            $res = $this->model->ipStack($ipAddress);
            $lat = $res["latitude"];
            $long = $res["longitude"];
            $country = $res["country_name"];
            $region = $res["region_name"];
        }
        $data = [
            "check" => $check,
            "hostname" => $hostname,
            "localIP" => $localIP,
            "type" => $version,
            "lat" => $lat,
            "long" => $long,
            "country" => $country,
            "region" => $region

        ];
        $page->add("ip/forms_geo", $data);
        return $page->render([
            "title" => $title,
        ]);
    }
}
