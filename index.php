<?php
require 'vendor/autoload.php'; 

use Config\Database\DBConfig as DB;

Config\Database\DBConnection::setDBConnection(
    DB::$user,DB::$password, 
    DB::$hostname, DB::$databaseType, DB::$port);

\Tools\Session::initialize();

if(isset($_GET['controller']))
    $controller = $_GET['controller'];
else if(\Tools\Access::islogin())
    $controller = "AdminPanel";
else
    $controller = 'Movie';
if(isset($_GET['action']))
    $action = $_GET['action'];
else if(\Tools\Access::islogin())
    $action = "adminPanel";
else
    $action = 'getAll';

if(isset($_GET['id']))
    $id = $_GET['id'];
else	
    $id = null;

$controller = 'Controllers\\'.$controller;

//tworzymy kontroler
$myController = new $controller();
$myController->$action($id);


