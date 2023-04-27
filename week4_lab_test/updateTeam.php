 <?php

  // This code runs everything the page loads
  require_once "controller/functions.php";
  require_once "model/custDB.php";

  if (isset($_GET['action'])) {
    $action = filter_input(INPUT_GET, 'action');
    $id =  filter_input(INPUT_GET, "customerID");
    if ($action == "Update") {
      $getCust = getOneCustomer($id);
      print_r($getCust);
      $fName = $getCust[0]['patientFirstName'];
      $lName = $getCust[0]['patientLastName'];
      $dob = $getCust[0]['patientBirthDate'];
      $married = $getCust[0]['patientMarried'];
    } else {
      $fName = "";
      $lName = "";
      $dob = "";
      $married = "";
    }
  }

  if (isset($_POST['action'])) {

    $action = filter_input(INPUT_POST, 'action');
    $id =  filter_input(INPUT_POST, "id");
    $fName =  filter_input(INPUT_POST, "fName");
    $lName =  filter_input(INPUT_POST, "lName");
    $dob =  filter_input(INPUT_POST, "dob");
    $married =  filter_input(INPUT_POST, "married");
  }

  if (isPostRequest() && $action == "Add") {
    $add = addCust($fName, $lName, $dob, $married);
    header('Location: viewTeams.php');
  } elseif (isPostRequest() && $action == "Update") {
    $update = updateCust($id, $fName, $lName, $dob, $married);
    header('Location: viewTeams.php');
  }

  if (empty($_POST) && empty($_GET)) {
    $fName = "";
    $lName = "";
    $dob = "";
    $married = "";
    $action = "";
  }




  ?>


 <html lang="en">

 <head>
   <title><?= $action ?> NFL Team</title>
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

       <input type="hidden" id="id" name="id" value="<?= $id ?>">
       <input type="hidden" id="action" name="action" value="<?= $action ?>">


       <div class="panel panel-primary">
         <div class="panel-heading">
           <h4><?= $action ?> customer</h4>
         </div>
         <p></p>
         <div class="form-group">
           <label class="control-label col-sm-2" for="fName">First Name:</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" id="fName" placeholder="Enter First Name" name="fName" required value="<?= $fName ?>">

           </div>
         </div>

         <div class="form-group">
           <label class="control-label col-sm-2" for="lName">last Name:</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" id="lName" placeholder="Enter Last Name" name="lName" required value="<?= $lName ?>">
           </div>
         </div>

         <div class="form-group">
           <label class="control-label col-sm-2" for="dob">Date Of Birth</label>
           <div class="col-sm-10">
             <input type="date" class="form-control" id="dob" name="dob" required value="<?= $dob ?>">
           </div>
         </div>

         <div class="form-group">
           <label class="control-label col-sm-2" for="Married">Married:</label>
           <div class="col-sm-10">
             <?php if ($married == 1) : ?>
               <input type="radio" id="married" name="married" value="0">NO
               <input type="radio" id="married" name="married" value="1" checked>YES
             <?php elseif ($married == 0) : ?>
               <input type="radio" id="married" name="married" value="0" checked>NO
               <input type="radio" id="married" name="married" value="1">YES
             <?php else : ?>
               <input type="radio" id="married" name="married" value="0">NO
               <input type="radio" id="married" name="married" value="1">YES
             <?php endif; ?>
           </div>
         </div>

         <div class="form-group">
           <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-default"> Update</button>
           </div>
         </div>
       </div>
       <p></p>

     </form>

     <div class="col-sm-offset-2 col-sm-10"><a href="./viewTeams.php">View Teams</a></div>
   </div>
   </div>

 </body>

 </html>