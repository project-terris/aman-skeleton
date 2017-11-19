<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 18/11/17
 * Time: 7:35 PM
 */


use Aman\Lib\Request\Request;

final class RequestFactory
{

    public static function createRequestFromCurrentContext(): Request{

        $requestRouteString = $_SERVER['REQUEST_URI'];
        $requestRouteMethod = $_SERVER['REQUEST_METHOD'];
        $requestBody = file_get_contents('php://input');
        $requestHeaders = getallheaders();

        $requestObject = new Request($requestRouteString, $requestBody, $requestRouteMethod, $requestHeaders);

        return $requestObject;

    }
}