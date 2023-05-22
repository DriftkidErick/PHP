<?php

include_once "customer.php";

class CustomerDB
{
    private $customerData;

    //building a contructor
    public function __construct($configFile)
    {
        //Parse config file, throw exception if it fails
        if ($ini = parse_ini_file($configFile))
        {

            // Create PHP Database Object
            $connectionString = "mysql:host=" . $ini['servername'] . 
            ";port=" . $ini['port'] . 
            ";dbname=" . $ini['dbname'];

            $customerPDO = new PDO( $connectionString, 
                                    $ini['username'], 
                                    $ini['password']);

            $customerPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            //Throws exceptions if there is an error in the database
            $customerPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Set our database to be the newly created PDO
            $this->customerData = $customerPDO;
        }
        else
        {
        
            // Things didn't go well, throw exception!
            throw new Exception( "<h2>Creation of database object failed!</h2>", 0, null );
        }
    } //End of the contructor

    public function getPatients() 
    {
        $results = [];                  // Array to hold results
        $customerTable = $this->customerData;   // Alias for database PDO

        // Preparing SQL query
        $stmt = $customerTable->prepare("SELECT * FROM patients ORDER BY patientLastName"); 
        
        // Execute query and check to see if rows were returned
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
            // if successful, grab all rows
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "Customer");                 
        }         

        // Return results to client
        return $results;
    }

    //*****************************************************************************
    // Add a patient to database
    // INPUT: patient info: first and last names, marital status and bday
    // RETURNS: True if add is successful, false otherwise
    public function addPatient($customerFName, $customerLName, $married, $dob) 
    {
        $addSucessful = false;         // Patient not added at this point
        $customerTable = $this->customerData;   // Alias for database PDO

        // Preparing SQL query with parameters for team and division
        $stmt = $customerTable->prepare("INSERT INTO patients SET patientFirstName = :patientFirstNameParam, patientLastName = :patientLastNameParam, patientMarried = :patientMarriedParam, patientBirthDate = :patientBirthDateParam ");

        // Bind query parameters to method parameter values
        $boundParams = array(
            ":patientFirstNameParam" => $customerFName,
            ":patientLastNameParam" => $customerLName,
            ":patientMarriedParam" => $married,
            ":patientBirthDateParam" => $dob,
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
    public function updatePatient ($id, $customerFName, $customerLName, $married, $dob) 
    {
        $updateSucessful = false;        // patient not updated at this point
        $customerTable = $this->customerData;   // Alias for database PDO

        // Preparing SQL query with parameters for patient and info
        //    id is used to ensure we update correct record
        $stmt = $customerTable->prepare("UPDATE patients SET patientFirstName = :patientFirstNameParam, patientLastName = :patientLastNameParam, patientMarried = :patientMarriedParam, patientBirthDate = :patientBirthDateParam WHERE id=:idParam");
        
         // Bind query parameters to method parameter values
        $stmt->bindValue(':idParam', $id);
        $stmt->bindValue(':patientFirstNameParam', $customerFName);
        $stmt->bindValue(':patientLastNameParam', $customerLName);
        $stmt->bindValue(':patientMarriedParam', $married);
        $stmt->bindValue(':patientBirthDateParam', $dob);

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
        $customerTable = $this->customerData;   // Alias for database PDO

        // Preparing SQL query 
        //    id is used to ensure we delete correct record
        $stmt = $customerTable->prepare("DELETE FROM patients WHERE id=:idParam");
        
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
        $customerTable = $this->customerData;   // Alias for database PDO

        // Preparing SQL query 
        //    id is used to ensure we delete correct record
        $stmt = $customerTable->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients WHERE id=:idParam");

         // Bind query parameter to method parameter value
        $stmt->bindValue(':idParam', $id);

         // Execute query and check to see if rows were returned 
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
            // if successful, grab the first row returned
            $results = $stmt->setFetchMode(PDO::FETCH_CLASS, "Customer");
            $results = $stmt->fetch();                       
        }
        // Return results to client
        return $results;
    }
    //*****************************************************************************
    public function getDatabaseRef()
    {
        return $this->customerData;
    }
    // Destructor to clean up any memory allocation
    public function __destruct() 
    {
       // Mark the PDO for deletion
        $this->customerData = null;
        // If we had a datafield that was a fileReference
        // we should ensure the file is closed
    }
}
?>