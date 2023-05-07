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
              <option value="teamName">Patient Last Name</option>
              <option value="division">Date of Birth</option>              
          </select>
       <input type="text" name="fieldValue" />
      <button type="submit" name="Search">Search</button>     
  </form>      
  <div style="background-color: #fff0cc; padding: 10px;">

  <h2>Sort Patients [<em>not implemented</em>]</h2>
<form  action="#" method="post">
    <input type="hidden" name="action" value="sort">
       <label>Sort By Field:&nbsp;&nbsp;&nbsp;</label>
       <select name="fieldName">
              <option value="">Select One</option>
              <option value="teamName">Patient Last Name</option>
              <option value="division">Date of Birth</option>    
              
          </select>
       <input type="radio" name="fieldValue" value="ASC" checked />Ascending
       <input type="radio" name="fieldValue" value="DESC" />Descending
       
      <button type="submit"  name="sortTeam">Sort</button>
</form>  
</div>
    <div class="col-sm-offset-2 col-sm-10">
        <h1>Patients</h1>
        <br />
        <a href="updateTeam.php?action=Add">Add New Patient</a>      
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last name</th>
                <th>Date of Birth</th>
                <th>Married</th>
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