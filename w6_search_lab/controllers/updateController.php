<?php
 
     // Load helper functions (which also starts the session) then check if user is logged in
     include_once __DIR__ . '/functions.php';
     if (!isUserLoggedIn())
     {
         header ('Location: login.php');
     }
 
     // This code runs everything the page loads
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
   
  // If it is a GET, we are coming from view.php
  // let's figure out if we're doing update or add
  if (isset($_GET['action'])) 
  {
      $action = filter_input(INPUT_GET, 'action');
      $id = filter_input(INPUT_GET, 'patientId', );
      if ($action == "Update") 
      {
        $currentPatient = $patientDatabase->getPatient($id);
        $patientFirstName = $currentPatient->getPatientFirstName();
        $patientLastName = $currentPatient->getPatientLastName();
        $patientMarried = $currentPatient->getPatientMarried();
        $patientBirthDate = $currentPatient->getPatientBirthDate();
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
      $patientFirstName = filter_input(INPUT_POST, 'patientFirstName');
      $patientLastName = filter_input(INPUT_POST, 'patientLastName');
      $patientMarried = filter_input(INPUT_POST, 'patientMarried');
      $patientBirthDate = filter_input(INPUT_POST, 'patientBirthDate');

      if ($action == "Add") 
      {
          $result = $patientDatabase->addPatient($patientFirstName, $patientLastName, $patientMarried, $patientBirthDate);
      } 
      elseif ($action == "Update") 
      {
          $result = $patientDatabase->updatePatient($id, $patientFirstName, $patientLastName, $patientMarried, $patientBirthDate);
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
      
    
    // Preliminaries are done, load HTML page header
 //   include_once __DIR__ . "/header.php";

?>