


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
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
            <input type="text" id="feet" name="feet" placeholder="0">
            <input type="text" id="inch" name="inch" placeholder="0">
        </div>

        &nbsp;

        <div>
        <label for='weight'>Weight</label>
            <input type="text" id="lbs" name="lbs" placeholder="0">
        </div>

        &nbsp;

        <div>
            <input type="submit" name="btnSub" value="Store info here">
        </div>


    </form>

    




</body>
</html>