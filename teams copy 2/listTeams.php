<?php

    // Load helper functions (which also starts the session) then check if user is logged in
    include_once __DIR__ . '/controllers/listController.php'; 
   // This loads HTML header and starts our session if it has not been started
   include_once __DIR__ . "/controllers/header.php";


?>
    <h2>Search for Patient</h2>
  <form action="#" method="post">
      <input type="hidden" name="action" value="search" />
      <label>Search by Field:</label>
       <select name="fieldName">
              <option value="">Select One</option>
              <!-- Here we are allowing users to search patients based off of options -->
              <option value="patientFirstName">First Name</option>
              <option value="patientLastName">Last Name</option>
              <option value="patientMarried">Married</option>              
          </select>
       <input type="text" name="fieldValue" />
      <button type="submit" name="Search">Search</button>     
  </form>      
 

 
</form>  
</div>
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
                <th>Date Of Birth</th>
                <th>Age</th>
                <th>Married</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($custListing as $row): ?>
            <tr>
                <td>
                <span type="hidden" name="teamId" value="<?= $row['id']; ?>"></span>
                <?= $row['id']; ?>
                </td>

                <td><?= $row['patientFirstName']; ?></td>
                <td><?= $row['patientLastName']; ?></td>
                <td><?= $row['patientBirthDate']; ?></td>

                <td>
                    <?php
                    
                        $today = date('Y-m-d'); //Sets date from todays date
                        //Grabs DOB from SQL DB and then makes it a date time
                        $patientBirthDate = DateTime::createFromFormat('Y-m-d', $row['patientBirthDate']);
                        //From Here we calculate the difference
                        $dateDiff = date_diff($patientBirthDate, date_create($today));
                        //Echo out the years only
                        echo $dateDiff->format('%y');?>
                    </td>


                <td><?php
                    if ($row['patientMarried'] == 0) {
                        echo "NO";
                    } else {
                        echo "YES";
                    };
                    ?>
                </td>

                <td><a href="updateTeam.php?action=Update&teamId=<?= $row['id'] ?>">Update</a></td>
                <td>
                    <form action="listTeams.php" method="post">
                        <input type="hidden" name="deleteTeam" value="<?= $row['id']; ?>" />


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