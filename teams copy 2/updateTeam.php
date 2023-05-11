 <?php
    // Load controller  (which also starts the session) and checks if user is logged in
    include_once __DIR__ . '/controllers/updateController.php';

    // Preliminaries are done, load HTML page header
    include_once __DIR__ . "/controllers/header.php";
?>
<p></p>
<form class="form-horizontal" action="updateTeam.php" method="post">
    
<div class="panel panel-primary">
         <div class="panel-heading">
           <h4><?= $action ?> Customer</h4>
         </div>
         <p></p>
         <div class="form-group">
           <label class="control-label col-sm-2" for="patientFirstName">First Name:</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" id="patientFirstName" placeholder="Enter First Name" name="patientFirstName" required value="<?= $patientFirstName ?>">

           </div>
         </div>

         <div class="form-group">
           <label class="control-label col-sm-2" for="patientLastName">last Name:</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" id="patientLastName" placeholder="Enter Last Name" name="patientLastName" required value="<?= $patientLastName ?>">
           </div>
         </div>

         <div class="form-group">
           <label class="control-label col-sm-2" for="patientBirthDate">Date Of Birth</label>
           <div class="col-sm-10">
             <input type="date" class="form-control" id="patientBirthDate" name="patientBirthDate" required value="<?= $patientBirthDate ?>">
           </div>
         </div>

         <div class="form-group">
           <label class="control-label col-sm-2" for="patientMarried">Married:</label>
           <div class="col-sm-10">
            <!--This is a block to make sure that the radio buttons remeber which button is selected-->
             <?php if ($patientMarried == 1) : ?>
               <input type="radio" id="patientMarried" name="patientMarried" value="0">NO
               <input type="radio" id="patientMarried" name="patientMarried" value="1" checked>YES
             <?php elseif ($patientMarried == 0) : ?>
               <input type="radio" id="patientMarried" name="patientMarried" value="0" checked>NO
               <input type="radio" id="patientMarried" name="patientMarried" value="1">YES
             <?php else : ?>
               <input type="radio" id="patientMarried" name="patientMarried" value="0" required>NO
               <input type="radio" id="patientMarried" name="patientMarried" value="1" required>YES
             <?php endif; ?>
           </div>
         </div>

         <div class="form-group">
           <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-default">Submit</button>
           </div>
         </div>
       </div>
       <p></p>

     </form>

     <div class="col-sm-offset-2 col-sm-10"><a href="./listTeams.php">View Patients</a></div>
   </div>
   </div>

</body>
</html>