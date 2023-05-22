<?php
    
    require_once "model/customerDB.php";
    require_once "functions.php";

    // Set up configuration file and create database
    require_once "model/dbpointer.php";  

    try 
    {
        $customerDatabase = new CustomerDB(DB_CONFIG_FILE);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    // If POST, delete the requested team before listing all teams
    if (isPostRequest()) {
        $id = filter_input(INPUT_POST, 'patientId');
        // $id = $_POST['patientId'];
        $customerDatabase->deletePatient($id);
    }
    $customerListing = $customerDatabase->getPatients();

?>