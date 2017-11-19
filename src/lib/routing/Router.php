<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 13/11/17
 * Time: 5:58 PM
 */

namespace Aman\Routing;

use Aman\Controllers\BaseController;
use Aman\Lib\Request\Request;

final class Router
{

    private $map = [];

    public function get(String $route, String $controllerFunction){
        $map["GET:$route"] = $controllerFunction;
    }

    public function post(String $route, String $controllerFunction){
        $map["POST:$route"] = $controllerFunction;
    }

    public function put(String $route, String $controllerFunction){
        $map["PUT:$route"] = $controllerFunction;
    }

    public function delete(String $route, String $controllerFunction){
        $map["DELETE:$route"] = $controllerFunction;
    }

    public function resolve(String $method, String $route){

        if(array_key_exists("$method:$route", $this->map)){
            $controllerMethodString = $this->map["$method:$route"];

            $index = strpos($controllerMethodString, "@");
            $class = substr($controllerMethodString, 0, $index);
            $method = substr($controllerMethodString, $index + 1);

            $fullClassName = "\Aman\Controllers\\$class";
            if(class_exists($fullClassName)){
                $instance = new $fullClassName;

                if(is_subclass_of($instance, 'BaseController')){

                    if(method_exists($instance, $method)){

                        //able to resolve the controller and method - passback method so app can pass request and contract
                        return function(Request $request, BaseContract $requestBody = null) use ($instance, $method) {
                            $instance->setRequestObject($request);
                            if($requestBody != null){
                                return $instance->$method($requestBody);
                            }else{
                                return $instance->$method();
                            }

                        };

                    }else{
                        // throw method not found exception
                    }

                }else{
                    // throw instance not extending base exception
                }

            }else{
                // throw class not found exception
            }
        }else{
            // throw map not found exception
        }
    }

}