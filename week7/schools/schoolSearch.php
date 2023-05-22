<?php

    include_once __DIR__ . "/model/Schools.php";
    include_once __DIR__ . "/include/functions.php";
   
    $configFile = __DIR__ . '/../schools/model/dbconfig.ini';
    try //To connect with the schools DB and create a new schools OBJ
    {
        $schoolData = new Schools($configFile);
    } 
    catch ( Exception $error ) //If theres an error throw it
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   

    $schoolListing = [];
    $schoolName = "";
    $city = "";
    $state = "";
    

    if (isPostRequest()) 
    {
        if (isset($schoolName))
        {
            $schoolName = $_POST['schoolName'];
        }
        if (isset($city))
        {
            $city = $_POST['schoolCity'];
        }
        if (isset($state))
        {
            $state = $_POST['schoolState'];
        }

        //Call the get schools functions and pass the params
        $schoolListing = $schoolData ->getSelectedSchools($schoolName, $city, $state);

    }

    include_once __DIR__ . "/include/header.php";
?>

    <h2>Search Schools</h2>
    <form method="post" action="schoolSearch.php">
        <div class="rowContainer">
            <div class="col1">School Name:</div>
            <div class="col2"><input type="text" name="schoolName" value="<?php echo $schoolName; ?>"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">City:</div>
            <div class="col2"><input type="text" name="schoolCity" value="<?php echo $city; ?>"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">State:</div>
            <div class="col2"><input type="text" name="schoolState" value="<?php echo $state; ?>"></div> 
        </div>
            <div class="rowContainer">
            <div class="col1">&nbsp;</div>
            <div class="col2"><input type="submit" name="search" value="Search" class="btn btn-warning"></div> 
        </div>
    </form>
            
    <div>
        <h2>Schools</h2>
        <br>    
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>School Name</th>
                    <th>City</th>
                    <th>State</th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach ($schoolListing as $row) : ?>
                    <tr>
                        <td>
                            <form action="schoolSearch.php" method="post">
                                <input type="hidden" name="schoolID" value="<?= $row['id']; ?>" />

                            </form>
                        </td>
                        <td><?= $row['schoolName']; ?></td>
                        <td><?= $row['schoolCity']; ?></td>
                        <td><?= $row['schoolState']; ?></td>
                    </tr>
                <?php endforeach ?>
                
            </tbody>
        </table>

    </div>
    <?php
    ?>


    <?php
        include_once __DIR__ . "/include/footer.php";
    ?>

