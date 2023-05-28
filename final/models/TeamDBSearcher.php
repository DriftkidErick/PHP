<?php

include_once __DIR__ . '/TeamDB.php'; 

// We extend the teams class so we can take advantage of work done earlier
class TeamDBSearcher extends TeamDB
{

    // Allows user to search for either team, division or both
    // INPUT: team and/or division to search for
    function searchTeams ($title, $author, $isbn) 
    {
        // We set up all the necessary variables here 
        // to ensure they are scoped for the entire function
        $results = array();             // tables of query results
        $binds = array();               // bind array for query parameters
        $teamTable = $this->getDatabaseRef();   // Alias for database PDO

        // Create base SQL statement that we can append
        // specific restrictions to
        $sqlQuery =  "SELECT * FROM  book   ";
        $isFirstClause = true;
        // If team is set, append team query and bind parameter
        if ($title != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  title LIKE :titleParam";
            $binds['titleParam'] = '%'.$title.'%';
        }
    
        // If division is set, append team query and bind parameter
        if ($author != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  author LIKE :authorParam";
            $binds['authorParam'] = '%'.$author.'%';
        }

        if ($isbn != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  isbn LIKE :isbnParam";
            $binds['isbnParam'] = '%'.$isbn.'%';
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