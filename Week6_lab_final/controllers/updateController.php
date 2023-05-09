<?php
// This code runs everything the page loads
require_once "models/PatientDB.php";

// Set up configuration file and create database
  require_once "models/dbpointer.php";  

  try 
  {
      $customerDatabase = new CustomerDB(DB_CONFIG_FILE);
  } 
  catch ( Exception $error )  //Will display an error if one is there
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
          $currentCustomer = $customerDatabase->getPatient($id);
          $customerFirstName = $currentCustomer->getPatientFirstName();
          $customerLastName = $currentCustomer->getPatientLastName();
          $customerMarried = $currentCustomer->getPatientMarried();
          $customerBirthDate = $currentCustomer->getPatientBirthDate();
      } 
      //else it is Add and the user will enter team & dvision
      else 
      {
          $customerFirstName = "";
          $customerLastName = "";
          $customerMarried = "";
          $customerBirthDate = "";
      }
} // end if GET

// If it is a POST, we are coming from updateTeam.php
// we need to determine action, then return to view.php
  elseif (isset($_POST['action'])) 
  {
      $action = filter_input(INPUT_POST, 'action');
      $id = filter_input(INPUT_POST, 'patientId');
      $customerFirstName = filter_input(INPUT_POST, 'patientFirstName');
      $customerLastName = filter_input(INPUT_POST, 'patientLastName');
      $customerMarried = filter_input(INPUT_POST, 'patientMarried');
      $customerAge = filter_input(INPUT_POST, 'patientAge');
      // Format the birth date as yyyy-mm-dd similar to the sql workbench database
      $customerBirthDate = date('Y-m-d', strtotime(filter_input(INPUT_POST, 'patientBirthDate')));


      if ($action == "Add") 
      {
          $result = $customerDatabase->addPatient($customerFirstName, $customerLastName, $customerMarried, $customerBirthDate);
      } 
      elseif ($action == "Update") 
      {//displays all fields including patient ID because it was assigned after adding patient to DB
          $result = $customerDatabase->updatePatient($id, $customerFirstName, $customerLastName, $customerMarried, $customerBirthDate);
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
