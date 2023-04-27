<?php

include_once 'Cust.php';

class CustDB
{
    //This represents the Database
    private $custData;

    public function __construct(($configFile))
    {
        //Parse config file, throw and exception if it fails
        if ($ini = parse_ini_file($configFile))
        {
            //Create a PHP database Object
            $connectionString = "mysql:host=" . $ini['servername'] . ";port=" . $ini['port'] . ";dbname=" . $ini['dbname'];

            $custPDO = new PDO($connectionString,
                                $ini['username'],
                                $ini['password']);
            
            //Dont emulate (pre-Complie) prepare statments
            $custPDO->setAtrribute(PDO::ATTR_EMULATE_PREPARES, false);

            //throws exceptions if there is any database error
            $custPDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            //Set Our database to be the newly created PDO
            $this->custData = $custPDO;
        }
        else
        {
            //There is an error
            throw new Exception("<h2>Creation of database object failed!</h2>",0,null);
        }
        
    }//Here is where constructor ends

    //Get a listing of all the patients
    public function getCustomer()
    {
        $results = []; //An array to hold all the results
        $custTable = $this->custData; 

        //Preparing SQL query
        $stmt = $custTable->prepare("SELECT * FROM patients ORDER BY lastname");

        //Execute query and check to see if rows were returned
        if ($stmt->execute() && $stmt->rowCount() > 0)
        {
            //if successful, grab all rows
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "Customer");
        }

        //Returns results to clients
        return $results;
    }

    //Add a person to a DB
    public function addCustomer($fName,$lName,$dob,$age,$married)
    {
        $addSuccessful = false;
        $custTable =  $this->custData;

        $stmt = $custTable ->prepare("INSERT INTO patients SET fName = :fNameParam, lName = :lnameParam, dob = :dobParam, age = :ageParam, married = :marriedParam");

        //Bind query parameters to method parameter values
        $boundParams = array(
            ":fNameParam" => $fName,
            ":lNameParam" => $lName,
            ":dobParam" => $dob,
            ":ageParam" => $age,
            ":marriedParam" => $married,
        );

        //Execute query and check to see if rows were returned
        //if so, the team was successfully added
        $addSuccessful = ($stmt->execute($boundParams) && $stmt->rowCount() > 0);

        //Returns this to the client
        return $addSuccessful;
    }

    public function addCustomer2($fName,$lName,$dob,$age,$married)
    {
        $addSuccessful = false;
        $custTable =  $this->custData;

        $stmt = $custTable ->prepare("INSERT INTO patients SET fName = :fNameParam, lName = :lnameParam, dob = :dobParam, age = :ageParam, married = :marriedParam");

        //Bind query parameters to method parameter values
        $stmt->bindValue(':fNameParam', $fName);
        $stmt->bindValue(':lNameParam', $lName);
        $stmt->bindValue(':dobParam', $dob);
        $stmt->bindValue(':ageParam', $age);
        $stmt->bindValue(':marriedParam', $married);

        //Execute query and check to see if rows were returned
        //if so, the team was successfully added
        $addSuccessful = ($stmt->execute($boundParams) && $stmt->rowCount() > 0);

        //Returns this to the client
        return $addSuccessful;
    }

    public function updateCustomer($id,$fName,$lName,$dob,$age,$married)
    {
        $updateSuccessful = false;
        $custTable = $this->custData;

        //prepare SQL query with parameteres for Customer information ID is used to make sure we are at the set parameter
        $stmt = $custTable->prepare("UPDATE patients SET fName = :fNameParam, lName = :lNameParam, dob = :dobParam, age = :ageParam, married = :marriedParam WHERE id = :idParam");

        //Binds the Query parameters to method paramerter values
        $stmt -> bindValue(':idParam', $id);
        $stmt -> bindValue('fNameParam', $fName);
        $stmt -> bindValue('lNameParam', $lName);
        $stmt -> bindValue('dobParam', $dob);
        $stmt -> bindValue('ageParam', $age);
        $stmt -> bindValue('marriedParam', $married);
       
        //Execute the query and checlk to see if the rows were returned
        //if so 
        $updateSuccessful = ($stmt -> execute() && $stmt->rowCount() > 0);

        //Return status to client
        return $updateSuccessful;
    }

    public function deleteTeam($id)
    {
        $deleteSucessful = false;       // Customer not updated at this point
        $custTable = $this -> custData; 

        //Prepare the SQL query 
        //id is used to ensure we delte correct record
        $stmt = $custTable ->prepare("DELETE FROM patients WHERE id = :idParam");

        //Bind the query param to method param value
        $stmt ->bindValue(':idParam', $id);

       // Execute query and check to see if rows were returned 
        // If so, the team was successfully deleted      
        $deleteSucessful = ($stmt->execute() && $stmt->rowCount() > 0);

        // Return status to client           
        return $deleteSucessful;
    }
    
    public function getCustomer($id)
    {
         $results = [];
         $custTable = $this->custData;

         //Prepare SQL query
         $stmt = $custTable->prepare("SELECT id,fName,lName,dob,age,married FROM patients WHERE id =:idParam");

        // Bind query parameter to method parameter value
        $stmt->bindValue(':idParam', $id);
       
        // Execute query and check to see if rows were returned 
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
           // if successful, grab the first row returned
           $results = $stmt->setFetchMode(PDO::FETCH_CLASS, "Customer");
           $results = $stmt->fetch();   
        }

        //return results to clients
        return $results;
    }

    public function getDatabaseRef()
    {
        return $this -> custData;
    }

    //Clean up any memory allocation
    public function __destruct()
    {
        //Mark the PDO for deletiojn
        $this->custData = null;
    }
}
?>

