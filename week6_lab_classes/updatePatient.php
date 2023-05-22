<?php

// This code runs everything the page loads
require_once "controller/updateController.php";

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
    <br/>
    <form class="form-horizontal" action="updatePatient.php" method="post">

      <div class="panel panel-info">
        <div class="panel-heading">
          <h4><?= $action; ?> Patient</h4>
        </div>

        <br/>
        <div class="form-group">
          <label class="control-label col-sm-2" for="patientFirstName">First Name:</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="patientFirstName" placeholder="Enter First Name" name="patientFirstName" required value="<?= $customerFName; ?>"> <!---gets value of first name from patient and displays in the update form-->
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="patientLastName">Last Name:</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="patientLastName" placeholder="Enter Last Name" name="patientLastName" required value="<?= $customerLName; ?>"><!---gets value of last name from patient and displays in the update form-->
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="patientMarried">Married:</label>
          <div class="col-sm-10"><!---gets value of marital status from patient and displays the checked radio value that was selected upon adding patient to DB-->

            <?php if ($married == 1) : ?>
              <input type="radio" name="patientMarried" id="yes" value="1" checked required>Yes
              <input type="radio" name="patientMarried" id="no" value="0" required>No

            <?php elseif ($married == 0) : ?>
              <input type="radio" name="patientMarried" id="yes" value="1" required>Yes
              <input type="radio" name="patientMarried" id="no" value="0" checked required>No

            <?php else : ?>
              <input type="radio" name="patientMarried" id="yes" value="1" required>Yes
              <input type="radio" name="patientMarried" id="no" value="0" required>No
            <?php endif; ?>
          </div>
        </div>

        <div class="form-group"><!---gets value of birthday from patient and displays in the update form-->
          <label class="control-label col-sm-2" for="patientBirthDate">Birth Date:</label>
          <div class="col-sm-2">
            <input type="date" class="form-control" id="patientBirthDate" name="patientBirthDate" required value="<?= $dob ?>">
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary"><?php echo $action; ?> Patient</button>
          </div>
        </div>
      </div>
      <br/>

    </form>

    <div class="col-sm-offset-2 col-sm-10"><a href="./viewPatients.php">View Patients</a></div>
  </div>

</body>
</html>
<hr>