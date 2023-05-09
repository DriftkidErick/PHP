<?php
    
    require_once "models/patientDB.php";
    require_once "functions.php";

    // Set up configuration file and create database
    require_once "models/dbpointer.php";  

    try 
    {
        $patientDatabase = new PatientDB(DB_CONFIG_FILE);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    // If POST, delete the requested team before listing all teams
    if (isPostRequest()) {
        $id = filter_input(INPUT_POST, 'patientID');
        // $id = $_POST['teamId'];
        $patientDatabase->deletePatient($id);

    }
    $patientListing = $patientDatabase->getPatient();
    
?>