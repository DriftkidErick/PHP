<?php

  // This code runs everything the page loads
    require_once "/model/customerDB.php";

  // Set up configuration file and create database
    require_once "/model/dbpointer.php";  

    try 
    {
        $customerDatabase = new CustomerDB(DB_CONFIG_FILE);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    
  // If it is a GET, we are coming from view.php
  // let's figure out if we're doing update or add
    if (isset($_GET['action'])) 
    {
        $action = filter_input(INPUT_GET, 'action');
        $id = filter_input(INPUT_GET, 'patientId', );
        if ($action == "Update") 
        {
            $currentPatient = $customerDatabase->getPatient($id);
            $customerFName = $currentPatient->getCustomerFName();
            $customerLName = $currentPatient->getCustomerLName();
            $married = $currentPatient->getMarried();
            $dob = $currentPatient->getDOB();
        } 
        //else it is Add and the user will enter team & dvision
        else 
        {
            $customerFName = "";
            $customerLName = "";
            $married = "";
            $dob = "";
        }
  } // end if GET

  // If it is a POST, we are coming from updateTeam.php
  // we need to determine action, then return to view.php
    elseif (isset($_POST['action'])) 
    {
        $action = filter_input(INPUT_POST, 'action');
        $id = filter_input(INPUT_POST, 'patientId');
        $customerFName = filter_input(INPUT_POST, 'patientFirstName');
        $customerLName = filter_input(INPUT_POST, 'patientLastName');
        $married = filter_input(INPUT_POST, 'patientMarried');
        $patientAge = filter_input(INPUT_POST, 'patientAge');
        // Format the birth date as yyyy-mm-dd similar to the sql workbench database
        $dob = date('Y-m-d', strtotime(filter_input(INPUT_POST, 'patientBirthDate')));


        if ($action == "Add") 
        {
            $result = $customerDatabase->addPatient($customerFName, $customerLName , $married, $dob);
        } 
        elseif ($action == "Update") 
        {//displays all fields including patient ID because it was assigned after adding patient to DB
            $result = $customerDatabase->updatePatient($id, $customerFName, $customerLName , $married, $dob);
        }

        // Redirect to team listing on view.php
        header('Location: viewPatients.php');
    } // end if POST

    // If it is neither POST nor GET, we go to view.php
    // This page should not be loaded directly
    else
    {
        header('Location: viewPatients.php');  
    }

?>

