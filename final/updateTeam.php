 <?php
    // Load controller  (which also starts the session) and checks if user is logged in
    include_once __DIR__ . '/controllers/updateController.php';

    // Preliminaries are done, load HTML page header
    include_once __DIR__ . "/controllers/header.php";
?>
<p></p>
<form class="form-horizontal" action="updateTeam.php" method="post">
    
    <div class="panel panel-info">
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
        <button type="submit" class="btn btn-primary"><?php echo $action; ?> Book</button>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary"><a href="./listTeams.php" style="color:white">View Books</a></div></button>
      </div>
    </div>
</div>


  </form>
  
</div>
</div>

</body>
</html>