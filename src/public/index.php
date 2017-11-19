<?php
ob_start();
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 18/11/17
 * Time: 7:34 PM
 */



require_once('../lib/AmanApplication.php');

$router = new \Aman\Routing\Router();

require_once("../router.php");

$configuration = new Configuration();

require_once("../config.php");

AmanApplication::start($router, $configuration);
ob_end_flush();