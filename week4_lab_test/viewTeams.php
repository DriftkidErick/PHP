<?php

//Included PHP files needed
require_once "model/custDB.php";
require_once "controller/functions.php";

//Var being set to function
$customerTb = getCustomer();

//Checks if it is a post request
if (isPostRequest()) {
    $id = filter_input(INPUT_POST, 'btnDel');
    deleteCust($id);
}

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
            <a href="updateTeam.php?action=Add">Add New Patient</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Of Birth</th>
                        <th>Age</th>
                        <th>Married</th>
                        <th>Update</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($customerTb as $currentRecord) : ?>
                        <tr>
                            <td>
                                <?= $currentRecord['id']; ?>

                            </td>
                            <td><?= $currentRecord['patientFirstName']; ?></td>
                            <td><?= $currentRecord['patientLastName']; ?></td>
                            <td><?= $currentRecord['patientBirthDate']; ?></td>

                            <td>
                                <?php
                                
                                 $today = date('Y-m-d'); //Sets date from todays date
                                 //Grabs DOB from SQL DB and then makes it a date time
                                 $patientBirthDate = DateTime::createFromFormat('Y-m-d', $currentRecord['patientBirthDate']);
                                 //From Here we calculate the difference
                                 $dateDiff = date_diff($patientBirthDate, date_create($today));
                                 //Echo out the years only
                                 echo $dateDiff->format('%y');?>
                             </td>


                            <td><?php
                                if ($currentRecord['patientMarried'] == 0) {
                                    echo "NO";
                                } else {
                                    echo "YES";
                                };
                                ?></td>
                            <td><a href="updateTeam.php?action=Update&customerID=<?= $currentRecord['id'] ?>">Update</a></td>
                            <td>
                                <form action="viewTeams.php" method="post">
                                    <input type="hidden" name="btnDel" value="<?= $currentRecord['id']; ?>" />


                                    <button class="btn glyphicon glyphicon-trash" type="submit"></button>
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