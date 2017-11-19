<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 13/11/17
 * Time: 6:32 PM
 */

namespace Aman\Controllers;

class BaseController
{

    private $request;

    public function setRequestObject(Request $request){
        $this->request = $request;
    }

    protected function getRequestObject():Request{
        return $this->request;
    }
}