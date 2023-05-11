 <?php
    // Load controller  (which also starts the session) and checks if user is logged in
    include_once __DIR__ . '/controllers/updateController.php';

    // Preliminaries are done, load HTML page header
    include_once __DIR__ . "/controllers/header.php";
?>
<p></p>
<form class="form-horizontal" action="updatePatient.php" method="post">
    
    <div class="panel panel-primary">
    <div class="panel-heading"><h4><?= $action; ?> Patient</h4></div>
    <p></p>
    <div class="form-group">
      <label class="control-label col-sm-2" for="patientFirstName">First Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="patientFirstName" placeholder="Enter first name" name="patientFirstName" required value="<?= $patientFirstName; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="patientLastName">Last Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="patientLastName" placeholder="Enter last name" name="patientLastName" required value="<?= $patientLastName; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="patientBirthDate">Birth Date:</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" id="patientBirthDate" name="patientBirthDate" required value="<?= $patientBirthDate; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="patientMarried">Married:</label>
        <div class="col-sm-10">

          <?php if ($patientMarried == 1) : ?>
            <input type="radio" name="patientMarried" id="yes" value="1" checked>Yes
            <input type="radio" name="patientMarried" id="no" value="0">No

          <?php elseif ($patientMarried == 0) : ?>
            <input type="radio" name="patientMarried" id="yes" value="1">Yes
            <input type="radio" name="patientMarried" id="no" value="0" checked>No

          <?php else : ?>
            <input type="radio" name="patientMarried" id="yes" value="1" required>Yes
            <input type="radio" name="patientMarried" id="no" value="0" required>No
          <?php endif; ?>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"><?php echo $action; ?> Patient</button>
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
  
  <div class="col-sm-offset-2 col-sm-10"><a href="./viewPatients.php">View Patient</a></div>
</div>
</div>

</body>
</html>