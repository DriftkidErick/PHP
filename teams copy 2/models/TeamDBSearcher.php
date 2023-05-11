<?php

include_once __DIR__ . '/TeamDB.php'; 

// We extend the teams class so we can take advantage of work done earlier
class TeamDBSearcher extends TeamDB
{

    // Allows user to search for either team, division or both
    // INPUT: team and/or division to search for
    function searchTeams ($patientFirstName, $patientLastName, $patientMarried) 
    {
        // We set up all the necessary variables here 
        // to ensure they are scoped for the entire function
        $results = array();             // tables of query results
        $binds = array();               // bind array for query parameters
        $custTable = $this->getDatabaseRef();   // Alias for database PDO

        // Create base SQL statement that we can append
        // specific restrictions to
        $sqlQuery =  "SELECT * FROM  patients   ";
        $isFirstClause = true;
        // If team is set, append team query and bind parameter
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
            $binds['patientFirstName'] = '%'.$patientFirstName.'%';
        }
    
        // If division is set, append team query and bind parameter
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
            $binds['patientLastName'] = '%'.$patientLastName.'%';
        }

        if ($patientMarried != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  patientMarried LIKE :patientMarriedParam";
            $binds['patientMarried'] = '%'.$patientMarried.'%';
        }
    
       
        // Create query object
        $stmt = $custTable->prepare($sqlQuery);

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