<?php

    // Load helper functions (which also starts the session) then check if user is logged in
    include_once __DIR__ . '/functions.php'; 
    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }

    // include team search class
    include_once __DIR__ . '/../models/patientDBSearcher.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '/../models/prod_dbconfig.ini';
    try 
    {
        $patientDatabase = new PatientDBSearcher($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    // If POST, delete the requested team before listing all teams
    $patientListing = [];

    // If POST & SEARCH, only fetch the specified teams       
    if (isset($_POST["Search"]))  //HEY CHECK THIS OUT
    {
        $patientFirstName = "";
        $patientLastName = "";
        $patientMarried = "";

        if ($_POST["fieldName"] == "patientFirstName")
        {
            $patientFirstName = $_POST['fieldValue'];
        }
        else
        {
            $division = $_POST['fieldValue'];
        }
        $patientListing = $patientDatabase->searchPatient($patientFirstName, $patientLastName, $patientMarried);
    }
    // If POST & DELETE, delete the requested team before fetching all teams       
    elseif (isset($_POST["deleteTeam"]))
    {
        $id = filter_input(INPUT_POST, 'teamId');
        $teamDatabase->deleteTeam($id);
        $teamListing = $teamDatabase->getTeams();
    }

    // Else just fetch all teams
    else
    {
        $patientListing = $patientDatabase->getPatients();
    }


    // This is a quick sorting hack that does not use
    // either the page form or a database query.
    // It sorts based on the associative array keys.
   //$teams  = array_column($teamListing, 'teamName');
   // $division = array_column($teamListing, 'division');

    //array_multisort($division, SORT_ASC, $teams, SORT_ASC, $teamListing);

// Preliminaries are done, load HTML page header
 //   include_once __DIR__ . "/header.php";

?>