<?php
 
 header("Access-Control-Allow-Origin: *");
 $Mysqli = new mysqli('localhost', 'root', '', 'AppRoadSOS');
 $request = $_SERVER['REQUEST_METHOD'] == 'GET' ? $_GET : $_POST;


?>
