 <?php
 
  // This code runs everything the page loads
  require_once "controllers/updateController.php";
  
?>
    

<html lang="en">
<head>
  <title><?= $action ?> Patient</title>
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
<div class="panel-heading"><h4><?= $action; ?> Patient</h4></div>
<p></p>
    <div class="form-group">
      <label class="control-label col-sm-2" for="fName" >First Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="fName" placeholder="Enter first name" required name="fName" value="<?= $patientFName; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="lName">Last Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="lName" placeholder="Enter last name" required name="lName" value="<?= $patientLName; ?>">
      </div>
    </div>

    <div class="form-group">
           <label class="control-label col-sm-2" for="dob">Date Of Birth</label>
           <div class="col-sm-10">
             <input type="date" class="form-control" id="dob" name="dob" required value="<?= $dob ?>">
           </div>
         </div>

    

    <div class="form-group">
      <label class="control-label col-sm-2" for="married">Married:</label>
      <div class="col-sm-10">
      <!--This is a block to make sure that the radio buttons remeber which button is selected-->
        <?php if ($married == 1) : ?>
          <input type="radio" id="married" name="married" value="0">NO
          <input type="radio" id="married" name="married" value="1" checked>YES
        <?php elseif ($married == 0) : ?>
          <input type="radio" id="married" name="married" value="0" checked>NO
          <input type="radio" id="married" name="married" value="1">YES
        <?php else : ?>
          <input type="radio" id="married" name="married" value="0" required>NO
          <input type="radio" id="married" name="married" value="1" required>YES
        <?php endif; ?>
      </div>
    </div>

    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"><?php echo $action; ?> Patient</button>
      </div>
    </div>
</div>
    

  </form>
  
  <div class="col-sm-offset-2 col-sm-10"><a href="./viewTeams.php">View Patients</a></div>
</div>
</div>

</body>
</html>