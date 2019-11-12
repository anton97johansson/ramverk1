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
    private $db = "not active";



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
        $this->db = "active";
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
        $ipAddress = $this->di->request->getGet("ip") ?? null;
        $hostname = null;
        $check = null;
        // $ipAddress = strval($ipAddress);
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
            "check" => json_encode(["ip" => $check,
                                    "domain" => $hostname])
            // "hostname" => $hostnam
        ];
        $page->add("ip/json_forms", $data);
        return $page->render([
            "title" => $title,
        ]);
    }

    // public function  jsonAction() : object
    // {
    //     $title = "IP JSON";
    //     $page = $this->di->get("page");
    //     $ipAddress = $this->di->request->getGet("ip") ?? null;
    //     $hostname = null;
    //     $check = null;
    //     // $ipAddress = strval($ipAddress);
    //     if ($ipAddress !== null) {
    //         if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) || filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
    //             $check = $ipAddress . " is OK";
    //             $hostname = gethostbyaddr($ipAddress);
    //             if ($hostname == $ipAddress) {
    //                 $hostname = "Not found";
    //             }
    //         } else {
    //             $check = $ipAddress . " is NOT OK";
    //             $hostname = "Not found";
    //         }
    //     }
    //
    //     $data = [
    //         "ip" => $check,
    //         "domain" => $hostname
    //
    //     ];
    //
    //     return [$data];
    // }
}
