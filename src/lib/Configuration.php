<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 18/11/17
 * Time: 7:58 PM
 */

class Configuration
{

    private $map = [];

    public function __set($name, $value)
    {
        $this->map[$name] = $value;
    }

    public function __get($name)
    {
        if(array_key_exists($name, $this->map)){
            return $this->map[$name];
        }else{
            return null;
        }
    }
}