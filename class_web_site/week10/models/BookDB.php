<?php

//*****************************************************
//
// This class provides a wrapper for the database 
// All methods work on the teams table

class BookDB
{
    // This data field represents the database
    private $bookData;

    //*****************************************************
    // Teams class constructor:
    // Instantiates a PDO object based on given URL and
    // uses that to initialize the data field $teamData
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

            $bookPDO = new PDO( $connectionString, 
                                $ini['username'], 
                                $ini['password']);

            // Don't emulate (pre-compile) prepare statements
            $bookPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // Throw exceptions if there is a database error
            $bookPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Set our database to be the newly created PDO
            $this->bookData = $bookPDO;
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

    //*****************************************************
    // Get listing of all teams
    // INPUT: None
    // RETURNS: Array with each entry representing a row in the table
    //          If no records in table, array is empty
    public function getBooks() 
    {
        $results = [];                  // Array to hold results
        $bookTable = $this->bookData;   // Alias for database PDO

        // Preparing SQL query
        $stmt = $bookTable->prepare("SELECT * FROM book ORDER BY title"); 
        
        // Execute query and check to see if rows were returned
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
            // if successful, grab all rows
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);                 
        }         

        // Return results to client
        return $results;
    }

    //*****************************************************
    // Add a team to database
    // INPUT: team and divison to add
    // RETURNS: True if add is successful, false otherwise
    public function addBook($title, $author, $releaseDate, $isbn, $genre) 
    {
        $addSucessful = false;         // Team not added at this point
        $bookTable = $this->bookData;   // Alias for database PDO

        // Preparing SQL query with parameters for team and division
        $stmt = $bookTable->prepare("INSERT INTO book SET title = :titleParam, author = :authorParam, releaseDate = :releaseDateParam, isbn = :isbnParam, genre = :genreParam");

        // Bind query parameters to method parameter values
        $boundParams = array(
            ":titleParam" => $title,
            ":authorParam" => $author,
            ":releaseDateParam" => $releaseDate,
            ":isbnParam" => $isbn,
            ":genreParam" => $genre
        );       
        
         // Execute query and check to see if rows were returned 
         // If so, the team was successfully added
        $addSucessful = ($stmt->execute($boundParams) && $stmt->rowCount() > 0);
        
         // Return status to client
         return $addSucessful;
    }
   
    //*****************************************************
     //*****************************************************
    // Add a team to database
    //   Uses alternative style to bind query parameters.
    // INPUT: team and divison to add
    // RETURNS: True if add is successful, false otherwise
    public function addBook2($title, $author, $releaseDate, $isbn, $genre) 
    {
        $addSucessful = false;         // Team not added at this point
        $bookTable = $this->bookData;   // Alias for database PDO

        // Preparing SQL query with parameters for team and division
        $stmt = $bookTable->prepare("INSERT INTO book SET title = :titleParam, author = :authorParam, releaseDate = :releaseDateParam, isbn = :isbnParam, genre = :genreParam");

        // Bind query parameters to method parameter values
        $stmt->bindValue(":titleParam", $title);
        $stmt->bindValue(":authorParam", $author);
        $stmt->bindValue(":releaseDateParam", $releaseDate);
        $stmt->bindValue(":isbnParam", $isbn);
        $stmt->bindValue(":genreParam", $genre);
       
        // Execute query and check to see if rows were returned 
        // If so, the team was successfully added
         $addSucessful = ($stmt->execute() && $stmt->rowCount() > 0);
        
         // Return status to client
         return $addSucessful;
    }

    //*****************************************************
    // Update specified team with a new name and division
    // INPUT: id of team to update
    //        new value for team name
    //        new value for division
    // RETURNS: True if update is successful, false otherwise
    public function updateBook ($id, $title, $author, $releaseDate, $isbn, $genre) 
    {
        $updateSucessful = false;        // Team not updated at this point
        $bookTable = $this->bookData;   // Alias for database PDO

        // Preparing SQL query with parameters for team and division
        //    id is used to ensure we update correct record
        $stmt = $bookTable->prepare("UPDATE book SET title = :titleParam, author = :authorParam, releaseDate = :releaseDateParam, isbn = :isbnParam, genre = :genreParam WHERE id=:idParam");
        
         // Bind query parameters to method parameter values
        $stmt->bindValue(':idParam', $id);
        $stmt->bindValue(":titleParam", $title);
        $stmt->bindValue(":authorParam", $author);
        $stmt->bindValue(":releaseDateParam", $releaseDate);
        $stmt->bindValue(":isbnParam", $isbn);
        $stmt->bindValue(":genreParam", $genre);

        // Execute query and check to see if rows were returned 
        // If so, the team was successfully updated      
        $updateSucessful = ($stmt->execute() && $stmt->rowCount() > 0);

          // Return status to client
          return $updateSucessful;
    }

    //*****************************************************
    // Delete specified team from table
    // INPUT: id of team to delete
    // RETURNS: True if update is successful, false otherwise
    public function deleteBook ($id) 
    {
        $deleteSucessful = false;       // Team not updated at this point
        $bookTable = $this->bookData;   // Alias for database PDO

        // Preparing SQL query 
        //    id is used to ensure we delete correct record
        $stmt = $bookTable->prepare("DELETE FROM book WHERE id=:idParam");
        
         // Bind query parameter to method parameter value
        $stmt->bindValue(':idParam', $id);
            
        // Execute query and check to see if rows were returned 
        // If so, the team was successfully deleted      
        $deleteSucessful = ($stmt->execute() && $stmt->rowCount() > 0);

        // Return status to client           
        return $deleteSucessful;
    }
 
    //*****************************************************
    // Get one team and place it into an associative array
    public function getBook ($id) 
    {
        $results = [];                  // Array to hold results
        $bookTable = $this->bookData;   // Alias for database PDO

        // Preparing SQL query 
        //    id is used to ensure we delete correct record
        $stmt = $bookTable->prepare("SELECT id, title, author, releaseDate, isbn, genre FROM book WHERE id=:idParam");

         // Bind query parameter to method parameter value
         $stmt->bindValue(':idParam', $id);
       
         // Execute query and check to see if rows were returned 
         if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
         {
            // if successful, grab the first row returned
            $results = $stmt->fetch();                       
        }

        // Return results to client
        return $results;
    }

    protected function getDatabaseRef()
    {
        return $this->bookData;
    }

    // Destructor to clean up any memory allocation
   public function __destruct() 
   {
       // Mark the PDO for deletion
       $this->bookData = null;

        // If we had a datafield that was a fileReference
        // we should ensure the file is closed
   }

 
} // end class Teams
?>