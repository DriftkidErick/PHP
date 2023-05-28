 <?php
    // Load controller  (which also starts the session) and checks if user is logged in
    include_once __DIR__ . '/controllers/updateController.php';

    // Preliminaries are done, load HTML page header
    include_once __DIR__ . "/controllers/header.php";
?>
<p></p>
<form class="form-horizontal" action="updateTeam.php" method="post">
    
    <div class="panel panel-primary">
    <div class="panel-heading"><h4><?= $action; ?> Book</h4></div>
    <p></p>

    <div class="form-group">
      <label class="control-label col-sm-2" for="title">Title:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="title" placeholder="Enter Book Title" name="title" value="<?= $title; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="author">Author's Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="author" placeholder="Enter Author's Name" name="author" value="<?= $author; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="releaseDate">Release Date:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="releaseDate" name="releaseDate" value="<?= $releaseDate; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="isbn">ISBN :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="isbn" name="isbn" value="<?= $isbn; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="genre">Genre:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="genre" name="genre" value="<?= $genre; ?>">
      </div>
    </div>

    
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"><?php echo $action; ?> Book</button>
      </div>
    </div>
</div>
    <p></p>
    <div class="panel panel-warning">
    <div class="panel-heading"><strong>This is for testing and verification:</strong></div>    
        Action: <input type="text" name="action" value="<?= $action; ?>">
        Book ID: <input type="text" name="teamId" value="<?= $id; ?>">
      </div>

  </form>
  
  <div class="col-sm-offset-2 col-sm-10"><a href="./listTeams.php">View Books</a></div>
</div>
</div>

</body>
</html>