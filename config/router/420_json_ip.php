<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "JSON IP controller",
            "mount" => "jsonip",
            "handler" => "\Anax\Controller\JsonIpController",
        ],
    ]
];
