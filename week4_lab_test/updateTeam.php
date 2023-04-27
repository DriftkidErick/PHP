 <?php
 
  // This code runs everything the page loads
  require_once "controller/functions.php";
  require_once "model/custDB.php";


  
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
<div class="panel-heading"><h4> Team</h4></div>
<p></p>
    <div class="form-group">
      <label class="control-label col-sm-2" for="fName">First Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="fName" placeholder="Enter First Name" name="fName " value="">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="lName">last Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="lName" placeholder="Enter Last Name" name="lName" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="dob">Date Of Birth</label>
      <div class="col-sm-10">          
        <input type="date" class="form-control" id="dob"  name="dob" value="">

      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="Married">Married:</label>
      <div class="col-sm-10">          
        <input type="radio" class="" id="married" name="married" value="0">NO
        <input type="radio" class="" id="married" name="married" value="1">YES
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"> Update</button>
      </div>
    </div>
</div>
    <p></p>
    <div class="panel panel-warning">
    <div class="panel-heading"><strong>This is for testing and verification:</strong></div>    
        Action: <input type="text" name="action" value="">
        Team ID: <input type="text" name="teamId" value="">
      </div>

  </form>
  
  <div class="col-sm-offset-2 col-sm-10"><a href="./viewTeams.php">View Teams</a></div>
</div>
</div>

</body>
</html>