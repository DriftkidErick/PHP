<?php
 
     // Load helper functions (which also starts the session) then check if user is logged in
     include_once __DIR__ . '/functions.php';
     if (!isUserLoggedIn())
     {
         header ('Location: login.php');
     }
 
     // This code runs everything the page loads
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
   
  // If it is a GET, we are coming from view.php
  // let's figure out if we're doing update or add
  if (isset($_GET['action'])) 
  {
      $action = filter_input(INPUT_GET, 'action');
      $id = filter_input(INPUT_GET, 'teamId', );
      if ($action == "Update") 
      {
          $currentRecord = $custDatabase->getTeam($id);
          $patientFirstName = $currentRecord['patientFirstName'];
          $patientLastName = $currentRecord['patientLastName'];
          $patientMarried = $currentRecord['patientMarried'];
          $patientBirthDate = $currentRecord['patientBirthDate'];
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
      $id = filter_input(INPUT_POST, 'teamId');
      $patientFirstName = filter_input(INPUT_POST, 'fName');
      $patientLastName = filter_input(INPUT_POST, 'lName');
      $patientMarried = filter_input(INPUT_POST, 'married');
      $patientBirthDate = filter_input(INPUT_POST, 'dob');

      if ($action == "Add") 
      {
          $result = $custDatabase->addTeam ($patientFirstName, $patientLastName, $patientMarried, $patientBirthDate);
      } 
      elseif ($action == "Update") 
      {
          $result = $custDatabase->updateTeam ($id, $patientFirstName, $patientLastName, $patientMarried, $patientBirthDate);
      }

      // Redirect to team listing on view.php
      header('Location: listTeams.php');
  } // end if POST

  // If it is neither POST nor GET, we go to view.php
  // This page should not be loaded directly
  else
  {
    header('Location: listTeams.php');  
  }
      
    
    // Preliminaries are done, load HTML page header
 //   include_once __DIR__ . "/header.php";

?>