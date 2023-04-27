 <?php
 
  // This code runs everything the page loads
  require_once "include/updateCustController.php";
  
?>
    

<html lang="en">
<head>
  <title><?= $action ?> NFL Team</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    
<div class="container">
  <p></p>
  <form class="form-horizontal" action="updateTeam.php" method="post">
    
  <div class="panel panel-primary">
<div class="panel-heading"><h4><?= $action; ?> Team</h4></div>
<p></p>
    <div class="form-group">
      <label class="control-label col-sm-2" for="lName">Last Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="cust" placeholder="Enter Patient last name" name="lName" value="<?= $lName; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Date of Birth:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="dob" placeholder="Enter date of birth" name="dob" value="<?= $dob; ?>">
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"><?php echo $action; ?> Pa</button>
      </div>
    </div>
</div>
    <p></p>
    <div class="panel panel-warning">
    <div class="panel-heading"><strong>This is for testing and verification:</strong></div>    
        Action: <input type="text" name="action" value="<?= $action; ?>">
        Team ID: <input type="text" name="teamId" value="<?= $id; ?>">
      </div>

  </form>
  
  <div class="col-sm-offset-2 col-sm-10"><a href="./viewTeams.php">View Teams</a></div>
</div>
</div>

</body>
</html>