<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 13/11/17
 * Time: 6:15 PM
 */


namespace Aman\Lib\Request;

use Aman\Exception\AmanException;


class Request
{
    private $requestBody = ""; // raw request body - has not been json_decoded
    private $requestMethod = "";
    private $requestRoute = "";
    private $requestHeaders = []; //associative array of header => headervalue

    public function __construct($requestRoute, $requestBody, $requestMethod, $requestHeaders){
        $this->requestBody = $requestBody;
        $this->requestMethod = $requestMethod;
        $this->requestHeaders = $requestHeaders;
        $this->requestRoute = $requestRoute;
    }

    /**
     * getRequestBody returns the request body made in the request. By default this data is stored as a raw string,
     * allowing for future parsing methods. When fetching the request body it is then decoded into JSON pending if the
     * $decodeBeforeReturning value is set to true
     * @param bool $decodeBeforeReturning - set whether to decode the data as JSON before returning or return the raw string
     * @return mixed - returns an associative array representing serialized JSON or a string representing the raw JSON
     * @throws AppException - thrown when json_decoding fails. This is so that the framework can properly return an error
     * to the user and handle invalid JSON data cases
     */
    public function getRequestBody($decodeBeforeReturning = true){
        if($decodeBeforeReturning){
            $requestBody = json_decode($this->requestBody, true);

            if(is_array($requestBody) && JSON_ERROR_NONE === json_last_error()){
                return $requestBody;
            }else{
                //throw new AmanException("Request Body Is Not Valid JSON", 400);
                throw new \Exception("Request body is invalid JSON. ERROR HANDLING NOT DEALT WITH");
            }

        }else{
            $this->requestBody;
        }
    }

    public function getRequestMethod(){
        return $this->requestMethod;
    }

    public function getRequestRoute(){
        return $this->requestRoute;
    }

    /**
     * getRequestHeader is a helper method for fetching headers within the request
     * @param $headerKey - key represenitng the header (eg. Authorization, Content-Type)
     * @param null $defaultReturn - value returned if the header does not exist
     * @return mixed|null - the value matching the header or the default value if specified
     */
    public function getRequestHeader($headerKey, $defaultReturn = null){

        if(array_key_exists($headerKey, $this->requestHeaders)){
            return $this->requestHeaders[$headerKey];
        }else{
            return $defaultReturn;
        }
    }

    /**
     * getAllRequestHeaders returns all request headers as an associative array of headerName => headerValue
     * @return array - all request headers as an associative array of headerName => headerValue
     */
    public function getAllRequestHeaders(){
        return $this->requestHeaders;
    }
}