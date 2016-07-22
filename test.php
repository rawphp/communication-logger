<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 23/07/16
 * Time: 7:27 AM
 */

require 'vendor/autoload.php';

$reader = new \RawPHP\CommunicationLogger\Util\Reader();

var_dump((string)\Ramsey\Uuid\Uuid::uuid4());
var_dump($reader->readDir(__DIR__));