<?php

include_once "patient.php";
//*****************************************************
//
// This class provides a wrapper for the database 
// All methods work on the patients table

class PatientDB
{
    // This data field represents the database
    private $patientData;

    //*****************************************************
    // patients class constructor:
    // Instantiates a PDO object based on given URL and
    // uses that to initialize the data field $patientData
    //
    // INPUT: URL of database configuration file
    // Throws exception if database access fails
    // ** This constructor is very generic and can be used to 
    // ** access your course database for any assignment
    // ** The methods need to be changed to hit the correct table(s)
    public function __construct($configFile) 
    {
        // Parse config file, throw exception if it fails
        if ($ini = parse_ini_file($configFile))
        {
            // Create PHP Database Object
            $connectionString = "mysql:host=" . $ini['servername'] . 
            ";port=" . $ini['port'] . 
            ";dbname=" . $ini['dbname'];

            $patientPDO = new PDO( $connectionString, 
                                $ini['username'], 
                                $ini['password']);
            // Don't emulate (pre-compile) prepare statements
            $patientPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // Throw exceptions if there is a database error
            $patientPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Set our database to be the newly created PDO
            $this->patientData = $patientPDO;
        }
        else
        {
            // Things didn't go well, throw exception!
            throw new Exception( "<h2>Creation of database object failed!</h2>", 0, null );
        }
    } // end constructor

// Database access & modify methods are listed below. 
// General structure of each method is:
//  1) Set up variable for database and query results
//  2) Set up SQL statement (with parameters, if needed)
//  3) Bind any parameters to values
//  4) Execute statement and check for returned rows
//  5) Return results if needed.

    //*****************************************************************************
    // Get listing of all patients
    // INPUT: None
    // RETURNS: Array with each entry representing a row in the table
    //          If no records in table, array is empty
    public function getPatients() 
    {
        $results = [];                  // Array to hold results
        $patientTable = $this->patientData;   // Alias for database PDO

        // Preparing SQL query
        $stmt = $patientTable->prepare("SELECT * FROM patients ORDER BY patientLastName"); 
        
        // Execute query and check to see if rows were returned
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
            // if successful, grab all rows
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "Patient");                 
        }         

        // Return results to client
        return $results;
    }

    //*****************************************************************************
    // Add a patient to database
    // INPUT: patient info: first and last names, marital status and bday
    // RETURNS: True if add is successful, false otherwise
    public function addPatient($patientFirstName, $patientLastName, $patientMarried, $patientBirthDate) 
    {
        $addSucessful = false;         // Patient not added at this point
        $patientTable = $this->patientData;   // Alias for database PDO

        // Preparing SQL query with parameters for team and division
        $stmt = $patientTable->prepare("INSERT INTO patients SET patientFirstName = :patientFirstNameParam, patientLastName = :patientLastNameParam, patientMarried = :patientMarriedParam, patientBirthDate = :patientBirthDateParam");

        // Bind query parameters to method parameter values
        $boundParams = array(
            ":patientFirstNameParam" => $patientFirstName,
            ":patientLastNameParam" => $patientLastName,
            ":patientMarriedParam" => $patientMarried,
            ":patientBirthDateParam" => $patientBirthDate,
        );       
        
         // Execute query and check to see if rows were returned 
         // If so, the team was successfully added
        $addSucessful = ($stmt->execute($boundParams) && $stmt->rowCount() > 0);
        
         // Return status to client
        return $addSucessful;
    }

    //*****************************************************************************
    // Update specified patient with all required parameters
    // INPUT: id of patient to update
    //        new value for name
    //        new value for marital status
    //        new value for birthdate
    // RETURNS: True if update is successful, false otherwise
    public function updatePatient ($id, $patientFirstName, $patientLastName, $patientMarried, $patientBirthDate) 
    {
        $updateSucessful = false;        // patient not updated at this point
        $patientTable = $this->patientData;   // Alias for database PDO

        // Preparing SQL query with parameters for patient and info
        //    id is used to ensure we update correct record
        $stmt = $patientTable->prepare("UPDATE patients SET patientFirstName = :patientFirstNameParam, patientLastName = :patientLastNameParam, patientMarried = :patientMarriedParam, patientBirthDate = :patientBirthDateParam WHERE id=:idParam");
        
         // Bind query parameters to method parameter values
        $stmt->bindValue(':idParam', $id);
        $stmt->bindValue(':patientFirstNameParam', $patientFirstName);
        $stmt->bindValue(':patientLastNameParam', $patientLastName);
        $stmt->bindValue(':patientMarriedParam', $patientMarried);
        $stmt->bindValue(':patientBirthDateParam', $patientBirthDate);

        // Execute query and check to see if rows were returned 
        // If so, the team was successfully updated      
        $updateSucessful = ($stmt->execute() && $stmt->rowCount() > 0);

        // Return status to client
        return $updateSucessful;
    }

    //*****************************************************************************
    // Delete specified patient from table
    // INPUT: id of patient to delete
    // RETURNS: True if update is successful, false otherwise
    public function deletePatient($id) 
    {
        $deleteSucessful = false;       // patient not updated at this point
        $patientTable = $this->patientData;   // Alias for database PDO

        // Preparing SQL query 
        //    id is used to ensure we delete correct record
        $stmt = $patientTable->prepare("DELETE FROM patients WHERE id=:idParam");
        
         // Bind query parameter to method parameter value
        $stmt->bindValue(':idParam', $id);
            
        // Execute query and check to see if rows were returned 
        // If so, the team was successfully deleted      
        $deleteSucessful = ($stmt->execute() && $stmt->rowCount() > 0);

        // Return status to client           
        return $deleteSucessful;
    }
    
    //*****************************************************************************
    // Get one team and place it into an associative array
    public function getPatient($id) 
    {
        $results = [];                  // Array to hold results
        $patientTable = $this->patientData;   // Alias for database PDO

        // Preparing SQL query 
        //    id is used to ensure we delete correct record
        $stmt = $patientTable->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients WHERE id=:idParam");

         // Bind query parameter to method parameter value
        $stmt->bindValue(':idParam', $id);

         // Execute query and check to see if rows were returned 
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
            // if successful, grab the first row returned
            $results = $stmt->setFetchMode(PDO::FETCH_CLASS, "Patient");
            $results = $stmt->fetch();                       
        }
        // Return results to client
        return $results;
    }
    //*****************************************************************************
    public function getDatabaseRef()
    {
        return $this->patientData;
    }
    // Destructor to clean up any memory allocation
    public function __destruct() 
    {
       // Mark the PDO for deletion
        $this->patientData = null;
        // If we had a datafield that was a fileReference
        // we should ensure the file is closed
    }

} // end class patients
?>