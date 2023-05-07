<?php

    include_once __DIR__ . '/functions.php';

    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }

    //Include the patient search class

    include_once __DIR__ . '/../models/TeamDbSearcher.php';

    //Set up config file and create database
    $configFile = __DIR__ . '/../model/prod_dbconfig.ini';
    try
    {
        $patientDatabase = new CustDBSearcher($configFile);
    }
    catch (Exeption $error)
    {
        echo '<h2>' . $error->getMessage() . "</h2>";
    }

    //If post, delete the requested patient before listing all patients
    $custListing = [];

    //if Post & Search, only fetch the specified patients
    if (isset($_POST["Search"]))
    {
        $fName = "";
        $lName = "";
        $dob = "";
        $married = "";
     
        if($_POST['patientName'] == '$lName')
        {
            $teamName = $_POST['fieldValue'];
        }
        else
        {
            $division = $_POST['fieldValue'];
        }
        $custListing = $CustDatabase->searchTeams($fName, $lName, $dob, $married);
    }
    // If POST & DELETE, delete the requested team before fetching all teams       
    elseif (isset($_POST["deleteTeam"]))
    {
        $id = filter_input(INPUT_POST, 'custId');
        $custDatabase->deleteTeam($id);
        $custListing = $custDatabase->getTeams();
    }

    // Else just fetch all teams
    else
    {
        $custListing = $custDatabase->getTeams();
    }


    // This is a quick sorting hack that does not use
    // either the page form or a database query.
    // It sorts based on the associative array keys.
    $teams  = array_column($custListing, 'teamName');
    $division = array_column($custListing, 'division');

    array_multisort($division, SORT_ASC, $teams, SORT_ASC, $teamListing);

// Preliminaries are done, load HTML page header
 //   include_once __DIR__ . "/header.php";

?>