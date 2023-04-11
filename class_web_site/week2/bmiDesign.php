<?php

include __DIR__ . '/../include//header.php'; //INCLUDES THE HEADER BY TIM HENRY

require_once 'bmi.php'; //Requires the functions 

//Create and array to store errors
$error = [];

if (isset($_POST['btnSub'])) //When the Submit buttons is pressed
{
    //First Name
    $fName = filter_input(INPUT_POST, 'fName');
    if($fName == "") //if first name is blank add error to array
    {
        $error[] = "<p>Must input a first name</p>";
    }

    //last Name
    $lName = filter_input(INPUT_POST, 'lName');
    if($lName == "") //if last name is blank add error to array
    {
        $error[] = "<p>Must input a last name</p>";
    }

    $feet = filter_input(INPUT_POST, 'feet', FILTER_VALIDATE_INT);
    if ($feet == "") //If feet is left blank
    {
        $error[] = "<p>Height Feet must be a whole number.</p>";
    }

    $inch = filter_input(INPUT_POST, 'inch', FILTER_VALIDATE_INT);
    if ($inch == "") //if inches is left blank
    {
        $error[] = "<p>Height Inches must be a whole number.</p>";
    }

    $weight = filter_input(INPUT_POST, 'lbs', FILTER_VALIDATE_FLOAT);
    if ($weight == "") //If weight is blank
    {
        $error[] = "<p>Weight must be a number. </p>";
    }

    if(empty($error)) //If the error array is empty print these out 
    {
    
        echo "<h2> Here are your results </h2>";
        echo "<p> First Name: " .($fName). "</p>";
        echo "<p> Last Name: " . ($lName) . "</p>";

        //Stores married input
        $married = filter_input(INPUT_POST, 'married');
        
        if ($married === "yes")
        {
            $married_status = "Yes";
        } 
        else
        {
            $married_status = "No";
        }

        echo "<p> Married: " . ($married_status) . "</p>";

        //Stores birthdate
        $bday = filter_input(INPUT_POST, 'bday');
        echo "<p> Birth Date: " . ($bday) . "</p>";

        //Calculates the age based on age function
        $age = age($bday);
        echo "<p> Age: " . ($age) . "</p>";

        echo "<p> Height: " . ($feet) . "ft " . ($inch) . "inch </p>";

        echo "<p> Weight: " . ($weight) . "lbs" . "</p>";

        //Calulates the bmi 
        $bmi = bmi($feet, $inch, $weight);
        echo "<p> Bmi: " . ($bmi) . "</p>";
        
        //Based on bmiDescription func will tell user their bmi
        echo "<p> Bmi: " . (bmiDescription($bmi)) . "</p>";

        echo "<hr />";
    }
    else //If there is and error
    {
        if ($error > 0)
        {
            echo "<h4> Sorry there are errors on the page </h4>";

            foreach ($error as $errors) //Prints out all the errors
            {
                echo $errors;
            }

            echo "<hr />";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <br>
    <form action="bmiDesign.php" method="post">
        <div>
            <label for="fName">First Name:</label>
            
            <input type="text" id="fName" name="fName" placeholder="John">
        </div>

        &nbsp;

        <div>
            <label for="lName">Last Name:</label>
            
            <input type="text" id="lName" name="lName" placeholder="Doe">
        </div>

        &nbsp;

        <div>
            <label for="married">Married:</label>
            

            <input type="radio" name="married" value="yes">Yes
            <input type="radio" name="married" value="no">No
        </div>

        &nbsp;

        <div>
            <label for="bday">Birthdate:</label>
            <input type="date" name="bday" >
        </div>

        &nbsp;

        <div>
            <label for='height'>Height</label>
            <input type="text" id="feet" name="feet" >
            <input type="text" id="inch" name="inch" >
        </div>

        &nbsp;

        <div>
        <label for='weight'>Weight</label>
            <input type="text" id="lbs" name="lbs" >
        </div>

        &nbsp;

        <div>
            <input type="submit" name="btnSub" value="Store info here">
        </div>


    </form>

    <?php include __DIR__ . '/../include/footer.php'; //Included footer by TIM HENRY ?> 
</body>
</html>