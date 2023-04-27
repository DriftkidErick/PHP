<?php

$ini = parse_ini_file( __DIR__ . "./prod_dbconfig.ini");

$db = new PDO   
(
    "mysql:host=" . $ini['servername'] . 
    ";port=" . $ini['port'] . 
    ";dbname=" . $ini['dbname'], 
    $ini['username'], 
    $ini['password']);

    echo $ini;
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,  false);


