<?php

    // Load helper functions (which also starts the session) then check if user is logged in
    include_once __DIR__ . '/controllers/listController.php'; 
   // This loads HTML header and starts our session if it has not been started
   include_once __DIR__ . "/controllers/header.php";

   require_once "models/patient.php";


?>
    <h2>Search for Patient</h2>
  <form action="#" method="post">
      <input type="hidden" name="action" value="search" />
      <label>Search by Field:</label>
       <select name="fieldName">
              <option value="">Select One</option>
              <option value="patientFirstName">First Name</option>
              <option value="patientLastName">Last Name</option>   
              <option value="patientMarried">Married</option>             
          </select>
       <input type="text" name="fieldValue" />
      <button type="submit" name="Search">Search</button>     
  </form>      
  <!-- <div style="background-color: #fff0cc; padding: 10px;"> -->

  <!-- <h2>Sort Teams [<em>not implemented</em>]</h2>
<form  action="#" method="post">
    <input type="hidden" name="action" value="sort">
       <label>Sort By Field:&nbsp;&nbsp;&nbsp;</label>
       <select name="fieldName">
              <option value="">Select One</option>
              <option value="teamName">Team Name</option>
              <option value="division">Division</option>
              
          </select>
       <input type="radio" name="fieldValue" value="ASC" checked />Ascending
       <input type="radio" name="fieldValue" value="DESC" />Descending
       
      <button type="submit"  name="sortTeam">Sort</button>
</form>   -->
</div>
    <div class="col-sm-offset-2 col-sm-10">
        <h1>Patient</h1>
        <br />
        <a href="updatePatient.php?action=Add">Add New Patient</a>      
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthdate</th>
                <th>Age</th>
                <th>Married</th>
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($patientListing as $currentPatient): ?>
            <tr>
                            <td><!--displays ID of patient that is given upon post-->
                                <form action="viewPatients.php" method="post">
                                <input type="hidden" name="patientId" value="<?= $currentPatient->getPatientId(); ?>" />
                                    <span name="patientId"><?= $currentPatient->getPatientId(); ?></span>
                                </form>
                            </td>

                            <!--retrieves patient first and last name-->
                            <td><?=$currentPatient->getPatientFirstName(); ?></td>
                            <td><?= $currentPatient->getPatientLastName(); ?></td>

                            <!--retrieves patient birthday from input using function-->
                            <td><?= $currentPatient->getPatientBirthDate(); ?></td>

                            <td><!--formats birthday then does calculation for Age of patient using date_diff function-->
                                <!-- <?php
                                // $today = date('Y-m-d');
                                // $patientBirthdate = DateTime::createFromFormat('Y-m-d',$currentPatient->getPatientBirthDate());
                                // $dateDiff = date_diff($patientBirthdate, date_create($today));
                                // echo $dateDiff->format('%y');
                                ?> -->
                            </td>

                            <td><!--Gets marriage information-->
                                <?php 
                                    if ($currentPatient->getPatientMarried() == 1)
                                    {
                                        echo "Yes";
                                    }
                                    else
                                    {
                                        echo "No";
                                    }
                                ?>
                            </td>

                            

                            

                            <!--sends page to update patient page that holds all information according to the patient ID-->
                            <td><a href="updatePatient.php?action=Update&patientId=<?= $currentPatient->getPatientId() ?>">Update</a></td>   

                            <td><!--on post method, implement delete and give a confirmation so you arent deleting records by accident!!-->
                                <form action="viewPatients.php" method="post"> 
                                    <input type="hidden" name="patientId" value="<?= $currentPatient->getPatientId(); ?>">
                                    <button class="btn glyphicon glyphicon-trash" name="delete" type="submit" onclick="return confirm('Are you sure you want to delete this patient?\n\t <?= $currentPatient->getPatientFirstName() . ' ' . $currentPatient->getPatientLastName() ?> ')"></button>
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