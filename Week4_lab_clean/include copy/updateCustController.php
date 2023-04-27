<?php

    //This runs everything the page loads
    require_once "models/CustDB.php";

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
            $currentCust = $custDataBase->getCustomer($id);
            $fName = $currentCust-> getfName();
            $lName = $currentCust -> getlName();
            $dob = $currentCust -> getdob();
            $age = $currentCust -> getage();
            $married = $currentCust-> getmarried();

        }
        //else it is Add and the user will enter info blank
        else
        {
            $fName = ""; 
            $lName = "";
            $dob = "";
            $age = "";
            $married = "";
        }
    }

    //if it is a POST , we are coming fro0m UpdateCust.php
    //We need to determine action, then return to view.PHP
    elseif(isset($_POST['action']))
    {   
        $action = filter_input(INPUT_POST, 'action');
        $id = filter_input(INPUT_POST, 'custId');
        $fName = filter_input(INPUT_POST, 'fName');
        $lName = filter_input(INPUT_POST, 'lName');
        $dob = filter_input(INPUT_POST, 'dob');
        $age = filter_input(INPUT_POST, 'age');
        $married = filter_input(INPUT_POST, 'married');

        if ($action == "Add") 
        {
            $result = $custDatabase->addTeam($fName,$lName,$dob,$age,$married);
        } 
        elseif ($action == "Update") 
        {
            $result = $teamDatabase->updateTeam($id, $fName, $lName, $dob, $age, $married);
        }

        // Redirect to team listing on view.php
        header('Location: viewTeams.php');
  } // end if POST

  // If it is neither POST nor GET, we go to view.php
  // This page should not be loaded directly
  else
  {
    header('Location: viewTeams.php');  
  }
    
?>
