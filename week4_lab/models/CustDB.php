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
        $stmt = $custTable->prepare("SELECT * FROM Customer ORDER BY lastname");

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
    public function addCustomer($fName,$lname,$dob,$age,$married)
    {
        
    }

}
?>