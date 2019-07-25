<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 7/23/19
 * Time: 11:50 PM
 */


// Load Composer autoload
use Classes\Api;

require_once __DIR__ . '/vendor/autoload.php';


$api = new Api();

$api->setLimit($_GET['limit'])
    ->setYear($_GET['year'])
    ->setSource($_GET['sourceId'])
    ->getJson();

