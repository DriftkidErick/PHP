<?php

include_once "models/patient.php";

class PatientDB
{
    private $patientData;

    
    public function __construct($configFile)
    {
        if ($ini = parse_ini_file($configFile))
        {

            //Creat PHP database Object
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
    } //End of contructor


    //Creationg of functions
    public function getPatient() 
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

    public function addPatient($patientFName, $patientLName, $married, $dob) 
    {
        $addSucessful = false;         // Team not added at this point
        $patientTable = $this->patientData;   // Alias for database PDO

        // Preparing SQL query with parameters for team and division
        $stmt = $patientTable->prepare("INSERT INTO patients SET patientFirstName = :fNameParam, patientLastName = :lNameParam, patientMarried = :marriedParam, patientBirthDate = :dobParam");

        // Bind query parameters to method parameter values
        $boundParams = array(
            ":fNameParam" => $patientFName,
            ":lNameParam" => $patientLName,
            ":marriedParam" => $married,
            ":dobParam" => $dob
        );       
        
         // Execute query and check to see if rows were returned 
         // If so, the team was successfully added
        $addSucessful = ($stmt->execute($boundParams) && $stmt->rowCount() > 0);
        
         // Return status to client
         return $addSucessful;
    }

    public function addPatient2($patientFName, $patientLName, $married, $dob) 
    {
        $addSucessful = false;         // Team not added at this point
        $patientTable = $this->patientData;   // Alias for database PDO

        // Preparing SQL query with parameters for team and division
        $stmt = $patientTable->prepare("INSERT INTO patients SET patientFirstName = :fNameParam, patientLastName = :lNameParam, patientMarried = :marriedParam, patientBirthDate = :dobParam");

        // Bind query parameters to method parameter values
        $stmt->bindValue(":fNameParam", $patientFName);
        $stmt->bindValue(":lNameParam", $patientLName);
        $stmt->bindValue(":marriedParam" , $married);
        $stmt->bindValue(":dobParam", $dob);

       
        // Execute query and check to see if rows were returned 
        // If so, the team was successfully added
         $addSucessful = ($stmt->execute() && $stmt->rowCount() > 0);
        
         // Return status to client
         return $addSucessful;
    }

    public function updatePatient($id,$patientFName, $patientLName, $married, $dob) 
    {
        $updateSucessful = false;        // Team not updated at this point
        $patientTable = $this->patientData;   // Alias for database PDO

        // Preparing SQL query with parameters for team and division
        //    id is used to ensure we update correct record
        $stmt = $patientTable->prepare("UPDATE patients SET patientFirstName = :fNameParam, patientLastName = :lNameParam, patientMarried = :marriedParam, patientBirthDate = :dobParam WHERE id=:idParam");
        
         // Bind query parameters to method parameter values
        $stmt->bindValue(':idParam', $id);
        $stmt->bindValue(":fNameParam", $patientFName);
        $stmt->bindValue(":lNameParam", $patientLName);
        $stmt->bindValue(":marriedParam", $married);
        $stmt->bindValue(":dobParam", $dob);

        // Execute query and check to see if rows were returned 
        // If so, the team was successfully updated      
        $updateSucessful = ($stmt->execute() && $stmt->rowCount() > 0);

          // Return status to client
          return $updateSucessful;
    }

    public function deletePatient($id) 
    {
        $deleteSucessful = false;       // Team not updated at this point
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

    public function getPatients($id) 
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
}
?>