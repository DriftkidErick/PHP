<?php

    // Load helper functions (which also starts the session) then check if user is logged in
    include_once __DIR__ . '/controllers/listController.php'; 
   // This loads HTML header and starts our session if it has not been started
   include_once __DIR__ . "/controllers/header.php";


?>
<style>

     body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;

        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 10px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            text-align: center;
            margin: 0 auto;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-group label {
            flex: 0 0 120px;
            font-size: 16px;
            color: #555;
        }

        .form-group input[type="text"] {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</style>
    <h2 style="text-align: center;">Search for a good book</h2>
  <form action="#" method="post">
      <input type="hidden" name="action" value="search" />
      <label>Search by Field:</label>
       <select name="fieldName" required>
              <option value="">Select One</option>
              <option value="title">Title</option>
              <option value="author">Author</option>
              <option value="isbn">ISBN</option>               
          </select>
       <input type="text" name="fieldValue" />
      <button type="submit" name="Search">Search</button>     
  </form>    
  
</div>
    <div class="col-sm-offset-1 col-sm-10">
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