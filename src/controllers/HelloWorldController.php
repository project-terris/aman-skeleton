<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 18/11/17
 * Time: 9:11 PM
 */

namespace Aman\Controllers;


use Aman\Contracts\GetContract;
use Aman\Lib\Response\GetResponse;

use Aman\Contracts\PostContract;
use Aman\Lib\Response\PostResponse;

class HelloWorldController extends BaseController
{

    //get requests don't have a body so the parameter is empty
    public function getHelloWorld():GetResponse{

        return new GetResponse();

    }

    //PostContract is the generic value - user should define their own that extends this
    //then framework can auto load their class with values and make sure it meets specs
    public function postHelloWorld(PostContract $requestBody):PostResponse{

        return new PostResponse();
    }

}