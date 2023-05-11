<?php

include_once __DIR__ . '/patientDB.php'; 

// We extend the teams class so we can take advantage of work done earlier
class PatientDBSearcher extends PatientDB
{

    // Allows user to search for either team, division or both
    // INPUT: team and/or division to search for
    function searchPatient ($patientFirstName, $patientLastName, $patientMarried) 
    {
        // We set up all the necessary variables here 
        // to ensure they are scoped for the entire function
        $results = array();             // tables of query results
        $binds = array();               // bind array for query parameters
        $patientTable = $this->getDatabaseRef();   // Alias for database PDO

        // Create base SQL statement that we can append
        // specific restrictions to
        $sqlQuery =  "SELECT * FROM  patients   ";
        $isFirstClause = true;
        // If patient First Name is set, append patient query and bind parameter
        if ($patientFirstName != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  patientFirstName LIKE :patientFirstNameParam";
            $binds['patientFirstNameParam'] = '%'.$patientFirstName.'%';
        }
    
        // If last name is set, append patient query and bind parameter
        if ($patientLastName != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  patientLastName LIKE :patientLastNameParam";
            $binds['patientLastNameParam'] = '%'.$patientLastName.'%';
        }

        //Now create one for mariage
        if ($patientMarried !="")
        {
            if ($isFirstClause)
            {
                $sqlQuery .= " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  patientMarried LIKE patientMarriedParam";
            $binds['patientMarriedParam'] = '%'.$patientMarried.'%';

        }

        // Create query object
        $stmt = $patientTable->prepare($sqlQuery);

        // Perform query
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) 
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // Return query rows (if any)
        return $results;
    } // end search teams
}

?>