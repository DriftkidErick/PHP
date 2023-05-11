<?php
require_once "controllers/viewController.php";

// This loads HTML header and starts our session if it has not been started

require_once "models/patient.php";
?>

<html lang="en">

<head>
    <title>View Patients</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

        <div class="col-sm-offset-2 col-sm-10">
            <h1>Patients</h1>
            <br />
            <a href="updateTeam.php?action=Add">Add New Patients</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Married</th>
                        <th>Date Of Birth</th>
                        <th>Age</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($patientListing as $currentPatient) : ?>
                        <tr>
                            <td>
                                <form action="viewTeams.php" method="post">
                                    <input type="hidden" name="patientID" id="patientID" value="<?= $currentPatient->getPatientId(); ?>"></input>
                                    <span name="patientID"><?= $currentPatient->getPatientId(); ?></span>
                                </form>
                            </td>
                            <!--Here i am going to grab the patients first name and last name-->
                            <td><?= $currentPatient->getPatientFName(); ?></td>
                            <td><?= $currentPatient->getPatientLName(); ?></td>

                            <!-- Here i am going to get their marriage status -->
                            <td>
                                <?php
                                if ($currentPatient->getMarried() == 0) //If they are not married it echos No
                                {
                                    echo "No";
                                } else //If they are married it will echo yes
                                {
                                    echo "Yes";
                                }
                                ?>
                            </td>

                            <!--Date of birth gets pulled -->
                            <td><?= $currentPatient->getDOB(); ?></td>

                            <!-- Here is a formula to get the current age -->
                            <td> 
                                <?php

                                        $today = date('Y-m-d'); //Sets date from todays date
                                        //Grabs DOB from SQL DB and then makes it a date time
                                        $patientBirthDate = DateTime::createFromFormat('Y-m-d', $currentPatient->getDOB());
                                        //From Here we calculate the difference
                                        $dateDiff = date_diff($patientBirthDate, date_create($today));
                                        //Echo out the years only
                                        echo $dateDiff->format('%y'); ?>
                            </td>



                            
                            <td><a href="updateTeam.php?action=Update&patientID=<?= $currentPatient->getPatientId(); ?>">Update</a></td>

                            <form action="viewTeams.php" method="post">
                            <input type="hidden" name="patientId" value="<?= $currentPatient->getPatientId(); ?>">
                                <td><button class="btn glyphicon glyphicon-trash" name="delete" type="submit"></button></td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>