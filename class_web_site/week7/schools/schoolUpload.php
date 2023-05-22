<?php
   include_once __DIR__ . "/model/Schools.php";
   include_once __DIR__ . "/include/functions.php";

//    If the user is not logged in send that back to the login
    If (!isUserLoggedIn())
    {
        header('Location: login.php');
    }

   $configFile = __DIR__ . '/../schools/model/dbconfig.ini';
    try //To connect with the schools DB and create a new schools OBJ
    {
        $schoolData = new Schools($configFile);
    } 
    catch ( Exception $error ) //If theres an error throw it
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }  
      

    if (isset ($_FILES['fileToUpload']))
    {

        $tmp_name = $_FILES['fileToUpload']['tmp_name'];

        $path = getcwd() . DIRECTORY_SEPARATOR . 'upload';
        
        $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['fileToUpload']['name'];

        move_uploaded_file($tmp_name, $new_name); //Moves csv to Upload folder

        $schoolData-> insertSchoolsFromFile($new_name); //Pushes to SQL

    }

    include_once __DIR__ . "/include/header.php"; 

?>  
    <h2>Upload File</h2>
    <p>
        Please specify a file to upload and then be patient as the upload may take a while to process.
    </p>

    <form action="schoolUpload.php" method="post" enctype="multipart/form-data">

        <input type="file" name="fileToUpload">
        <input type="submit" value="Upload">

    </form>    


<?php
    include_once __DIR__ . "/include/footer.php";
?>
