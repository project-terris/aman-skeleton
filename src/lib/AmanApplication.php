<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 18/11/17
 * Time: 7:44 PM
 */

use Aman\Lib\Response\Response;
use Aman\Lib\Request\Request;
use Aman\Routing\Router;

final class AmanApplication
{
    private $configuration;
    private $router;

    private function __construct(Router $router, Configuration $configuration)
    {
        $this->router = $router;
        $this->configuration = $configuration;
    }


    //entry location - acts as singleton constructor for application - may do error handling / exception catching
    public static function start(Router $router, Configuration $configuration){

        $aman =  new AmanApplication($router, $configuration);
        $aman->processRequest();

    }

    private function respondToClient(Response $response){



    }

    private function processRequest(): Response{

        //make call to middleware pre-request

        //create the request object
        $requestObject = RequestFactory::createRequestFromCurrentContext();

        //make call to middleware request pre-routed

        //ask the router where to send it
        $controllerClosure = $this->router->resolve($requestObject);

        //make call to middleware pre controller

        //send it to that controller - returning the response
        $responseObject = $controllerClosure($requestObject);

        //make call to middle ware pre-response/post-controller

        //call respondToClient to process
        $this->respondToClient($responseObject);

    }
}