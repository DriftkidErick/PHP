<?php
    include __DIR__ . '/model/custDB.php';
    include __DIR__ . '/controller/functions.php';

    //Starting the session
    session_start();
    
    $error = false;

    if(isPostRequest()) 
    {
        //This sets the session Vars
        $_SESSION['userName'] = filter_input(INPUT_POST, 'userName'); //Pulled from the textBox
        $_SESSION['password'] = filter_input(INPUT_POST, 'password');//Pulled from the textBox

        //If the getLogin was successful send them to viewTeams
        if (getLogin($_SESSION['userName'], $_SESSION['password']) == "Login was Successful")
        {
            header('Location: viewTeams.php');
        }
        else //If its false throw and error
        {
            $error = true;
            
        }
    }

?>

<div class="container">

    <h2>Please Login</h2>

    <?php 
        //If there is an $error it will throw the error message 
        if ($error == true)
        {   ?>
            <div style="background-color: yellow; padding: 10px; border: solid 1px black;"> 
           <?php echo "Sorry there seems to be an error!! " . $_SESSION['userName'] .
            $_SESSION['password']?>
           </div>
        <?php } ?>

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