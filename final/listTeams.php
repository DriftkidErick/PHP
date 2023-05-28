<?php

    // Load helper functions (which also starts the session) then check if user is logged in
    include_once __DIR__ . '/controllers/listController.php'; 
   // This loads HTML header and starts our session if it has not been started
   include_once __DIR__ . "/controllers/header.php";


?>
    <h2>Search for a good book</h2>
  <form action="#" method="post">
      <input type="hidden" name="action" value="search" />
      <label>Search by Field:</label>
       <select name="fieldName" required>
              <option value="">Select One</option>
              <option value="patientFirstName">Title</option>
              <option value="patientLastName">Author</option>
              <option value="patientMarried">ISBN</option>               
          </select>
       <input type="text" name="fieldValue" />
      <button type="submit" name="Search">Search</button>     
  </form>    
  
</div>
    <div class="col-10 center-table">
        <h1>Library</h1>
        <br />
        <a href="updateTeam.php?action=Add">Add A New Book</a>      
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Time of Release</th>
                <th>Isbn</th>
                <th>Genre</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($teamListing as $row): ?>
            <tr>
                
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['author']; ?></td> 
                <td><?php echo $row['releaseDate']; ?></td> 
                <td><?php echo $row['isbn']; ?></td> 
                <td><?php echo $row['genre']; ?></td> 


                <td><a href="updateTeam.php?action=Update&teamId=<?= $row['id'] ?>">Update</a></td> 

                <td>
                    <form action="listTeams.php" method="post">
                        <input type="hidden" name="teamId" value="<?= $row['id']; ?>" />
                        <button class="btn glyphicon glyphicon-trash" name="deleteTeam" type="submit"></button>
                        
                    </form>   
                </td>
                
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
       
    </div>
    </div>
</body>
</html>