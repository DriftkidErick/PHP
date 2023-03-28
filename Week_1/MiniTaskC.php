<html>
<head>

</head>
<body>

    <h1 style="text-align:center ;">

        <?php
            echo "Hello User Welcome to My Week 1 Mini Task C!";
        ?>

    </h1>

    <p> Here is a list of some random animals </p>

    <ul>

        <?php //This will loop through each animal and 

            foreach ($animals as $animalNames)
            {
                echo "<li>$animalNames</li>";
            }

        ?>


        </ul>




    
</body>
</html>


<!-- Our Goal here is to 
    * make an array of animals 
    * display the names  as list items

    *Personal approach is to try to use a for loop
-->