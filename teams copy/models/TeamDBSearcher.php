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
        $teamTable = $this->getDatabaseRef();   // Alias for database PDO

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
            $binds['patientFirstNameParam'] = '%'.$patientFirstName.'%';
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
            $binds['patientLastNameParam'] = '%'.$patientLastName.'%';
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

            if (strtolower($patientMarried) === "yes" || $patientMarried === "1") 
            {
                $sqlQuery .= "patientMarried = :patientMarriedParam";
                $binds['patientMarriedParam'] = '1';
            }
            else if (strtolower($patientMarried) === "no" || $patientMarried === "0") 
            {
                $sqlQuery .= "patientMarried = :patientMarriedParam";
                $binds['patientMarriedParam'] = '0';
            }
            else 
            {
                header("Location: listTeams.php");
            }
        }
    
       
        // Create query object
        $stmt = $teamTable->prepare($sqlQuery);

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