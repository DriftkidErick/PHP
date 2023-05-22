<?php
   
    include (__DIR__ . "/controller/viewController.php");
    include_once "./controller/functions.php";
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
            <a href="updatePatient.php?action=Add">Add New Patient</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Married</th>
                        <th>Birthdate</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($customerListing as $currentPatient) : ?>
                        <tr>
                            <td><!--displays ID of patient that is given upon post-->
                                <form action="viewPatients.php" method="post">
                                    <span name="patientId"><?= $currentPatient->getCustomerId(); ?></span>
                                </form>
                            </td>

                            <!--retrieves patient first and last name-->
                            <td><?=$currentPatient->getCustomerFName(); ?></td>
                            <td><?= $currentPatient->getCustomerLName(); ?></td>

                            <td><!--retrieves marital status and instead of display 1 or 0, echo yes or no if married-->
                                <?php 
                                    if ($currentPatient->getMarried() == 1){
                                        echo "Yes";
                                    }else{
                                        echo "No";
                                    }
                                ?>
                            </td>

                            <!--retrieves patient birthday from input using function-->
                            <td><?= $currentPatient->getDOB(); ?></td>

                            <td><!--formats birthday then does calculation for Age of patient using date_diff function-->
                                <?php
                                $today = date('Y-m-d');
                                $dob = DateTime::createFromFormat('Y-m-d',$currentPatient->getDOB());
                                $dateDiff = date_diff($dob, date_create($today));
                                echo $dateDiff->format('%y');
                                ?>
                            </td>

                            <!--sends page to update patient page that holds all information according to the patient ID-->
                            <td><a href="updatePatient.php?action=Update&patientId=<?= $currentPatient->getCustomerId() ?>">Update</a></td>   

                            <td><!--on post method, implement delete and give a confirmation so you arent deleting records by accident!!-->
                                <form action="viewPatients.php" method="post"> 
                                    <input type="hidden" name="patientId" value="<?= $currentPatient->getCustomerId(); ?>">
                                    <button class="btn glyphicon glyphicon-trash" name="delete" type="submit" onclick="return confirm('Are you sure you want to delete this patient?\n\t <?= $currentPatient->getCustomerFName() . ' ' . $currentPatient->getCustomerLName() ?> ')"></button>
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
<hr>


