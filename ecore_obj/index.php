<?php
 
require 'vendor/autoload.php';
 
use ecore\Connection as Connection;
 
try {
    Connection::get()->connect();
    header("location: login.php");
} catch (\PDOException $e) {
    echo $e->getMessage();
}