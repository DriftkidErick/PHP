<?php
    
    // Include helper utility functions
    include_once __DIR__ . '/include/functions.php';

    // Include user database definitions
    include_once __DIR__ . '/model/Users.php';

    // This loads HTML header and starts our session if it has not been started
    include_once __DIR__ . "/include/header.php";


    // set logged in to false
    $_SESSION['isLoggedIn'] = false;
    
    // If this is a POST, check to see if user credentials are valid.
    // First we need to gab the crednetials form the form 
    //      and create a user database object
    $message = "";
    if (isPostRequest()) 
    {

        // get _POST form fields
        $username = filter_input(INPUT_POST, 'userName');
        $password = filter_input(INPUT_POST, 'password');

        // Set up configuration file and create database
        // Set up the DIR this way because its the only way it works
        $configFile = __DIR__ . '/../schools/model/dbconfig.ini';
        try 
        {
            $userDatabase = new Users($configFile);
        } 
        catch ( Exception $error ) 
        {
            echo "<h2>" . $error->getMessage() . "</h2>";
        }   
    
        // Now we can check to see if use credentials are valid.
        if ($userDatabase->validateCredentials($username, $password)) 
        {
            // If so, set logged in to TRUE
            $_SESSION['isLoggedIn'] = true;
            // Redirect to team listing page
            header ('Location: schoolUpload.php');
        } 
        else 
        {
           // Whoops! Incorrect login. Tell user and stay on this page.
           $message = "You did not enter  correct login credentials. 🤨";
        }
 
    }

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
        #mainDiv {margin-left: 100px; margin-top: 100px;}
        .col1 {width: 100px; float: left;}
        .col2 {float: left;}
        .rowContainer {clear: left; height: 40px;}
        .error {margin-left: 100px; clear: left; height: 40px; color: red;}
    </style>
<title>Schools Upload</title>
</head>
<body>
    <?php
      include_once __DIR__ . "/include/header.php";
?>

    <div id="mainDiv">
        <form method="post" action="login.php">
           
            <div class="rowContainer">
                <h3>Please Login</h3>
            </div>
            <div class="rowContainer">
                <div class="col1">User Name:</div>
                <div class="col2"><input type="text" name="userName" value="donald"></div> 
            </div>
            <div class="rowContainer">
                <div class="col1">Password:</div>
                <div class="col2"><input type="password" name="password" value="duck"></div> 
            </div>
              <div class="rowContainer">
                <div class="col1">&nbsp;</div>
                <div class="col2"><input type="submit" name="login" value="Login" class="btn btn-warning"></div> 
            </div>
            
        </form>
        
    </div>
    <?php
      include_once __DIR__ . "/include/footer.php";
?>


</body>
</html>