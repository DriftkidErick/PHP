<?php
 
  // This code runs everything the page loads
  require_once "models/patientDB.php";

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
   
  // If it is a GET, we are coming from view.php
  // let's figure out if we're doing update or add
  if (isset($_GET['action'])) 
  {
      $action = filter_input(INPUT_GET, 'action');
      $id = filter_input(INPUT_GET, 'patientID', );
      if ($action == "Update") 
      {
          $currentPatient = $patientDatabase->getPatients($id);
          $patientFirstName = $currentPatient->getPatientFName();
          $patientLastName = $currentPatient->getPatientLName();
          $patientMarried = $currentPatient->getMarried();
          $patientBirthDate = $currentPatient->getDOB();
      } 
      //else it is Add and the user will enter team & dvision
      else 
      {
          $patientFirstName = "";
          $patientLastName = "";
          $patientMarried = "";
          $patientBirthDate = "";

      }
  } // end if GET

  // If it is a POST, we are coming from updateTeam.php
  // we need to determine action, then return to view.php
  elseif (isset($_POST['action'])) 
  {
      $action = filter_input(INPUT_POST, 'action');
      $id = filter_input(INPUT_POST, 'patientId');
      $patientFirstName = filter_input(INPUT_POST, 'fName');
      $patientLastName = filter_input(INPUT_POST, 'lName');
      $patientMarried = filter_input(INPUT_POST, 'married');
      $patientBirthDate = filter_input(INPUT_POST, 'dob');


      if ($action == "Add") 
      {
          $result = $patientDatabase->addPatient($patientFirstName, $patientLastName, $patientMarried, $patientBirthDate);
      } 
      elseif ($action == "Update") 
      {
          $result = $patientDatabase->updatePatient($id, $patientFirstName, $patientLastName, $patientMarried, $patientBirthDate);
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