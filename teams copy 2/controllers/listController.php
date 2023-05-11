<?php

    // Load helper functions (which also starts the session) then check if user is logged in
    include_once __DIR__ . '/functions.php'; 
    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }

    // include team search class
    include_once __DIR__ . '/../models/TeamDBSearcher.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '/../models/dbconfig.ini';
    try 
    {
        $custDatabase = new TeamDBSearcher($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    // If POST, delete the requested team before listing all teams
    $custListing = [];

    // If POST & SEARCH, only fetch the specified teams       
    if (isset($_POST["Search"]))
    {
        $patientFirstName="";
        $patientLastName="";
        $patientMarried="";

        if ($_POST["fieldName"] == "patientFirstName")
        {
            $patientFirstName = $_POST['fieldValue'];
        }
        else if ($_POST["fieldName"] == "patientLastName")
        {
            $patientLastName = $_POST['fieldValue'];
        }
        else
        {
            $patientMarried = $_POST['fieldValue'];
        }
        $custListing = $custDatabase->searchTeams($patientFirstName, $patientLastName, $patientMarried);
    }
    // If POST & DELETE, delete the requested team before fetching all teams       
    elseif (isset($_POST["deleteTeam"]))
    {
        $id = filter_input(INPUT_POST, 'teamId');
        $custDatabase->deleteTeam($id);
        $custListing = $custDatabase->getTeams();
    }

    // Else just fetch all teams
    else
    {
        $custListing = $custDatabase->getTeams();
    }


//     // This is a quick sorting hack that does not use
//     // either the page form or a database query.
//     // It sorts based on the associative array keys.
//     $teams  = array_column($teamListing, 'teamName');
//     $division = array_column($teamListing, 'division');

//     array_multisort($division, SORT_ASC, $teams, SORT_ASC, $teamListing);

// // Preliminaries are done, load HTML page header
//  //   include_once __DIR__ . "/header.php";

?>