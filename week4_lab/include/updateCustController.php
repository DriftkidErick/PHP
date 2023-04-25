<?php

//This runs everything the page loads
require_once "models/TeamDB.php";

//Set up config file and create DB
require_once 'models/dbpointer.php';

//Starts with a try catch to connect
try //Try to preform action
{
    $custDataBase = New CustDB(DB_CONFIG_FILE); //New CustDB instance
}
catch (Exception $error)//Catch and display any errors
{
    echo "<h2>" . $error->getMessage() . "</h2>";
}

//This checks if its a GEt
if(isset($_GET['action']))
{
    $action = filter_input(INPUT_GET, 'action');
    $id = filter_input(INPUT_GET, 'custID');

    if ($action === "Update")
    {
        $currentCust = $custDataBase->get;
    }
}
?>
fewfbweuofngwfonwo viosnvdawnfovasld faiwnevc asod aoiw erviasvawniv aiv oaw efl vosdnvw aejofvnaips v weeoipv wipa voj wrlfnojaw efweif aefoj  f nwlj