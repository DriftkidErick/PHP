<html>


    <body>

        

        <?php

            echo "<h2>Welcome to SE266. PHP Rocks!!!!!</h2>";

            //integrer
            $stuff = 10;
            echo $stuff . "<br />";

            //string
            $stuff = "Whatever";
            echo $stuff . "<br />";

            $myArray = array('rocks', 'pebbles', 'sand');
            echo count($myArray) . "<br />";
        ?>

        <ul>

            <?php for($index = 0; $index < count($myArray); $index++)
                {
                    echo "<li>" . $myArray[$index] . "</li>";

                }

                var_dump($myArray);

                echo "<p> display w/print_r </p>";
                print_r($myArray);

                //Using the explode
                $statement = "PHP is a cool langauge!!!!!!!!!!!";
                $statementArray = explode(" ", $statement);

                echo "<p></p>";
                print_r($statementArray);

                echo nl2br("\n \n \n \t \t HERE I AM!! \n");

                //Randon num gen
                echo mt_rand(1, 10);

                //concatinating strings
                $myvar1 = "hello";
                $myvar2 = "World";

                ?>

                <p>
                    <?php echo $myvar1 . ' ' . $myvar2; ?>
                </p>

                <p>
                    <?php echo "$myvar1 $myvar2"; //Double quotes ?>
                </p>

                <p>
                    <?php echo '$myvar1 $myvar2'; //Single quotes ?>
                </p>
            ?>
        </ul>
        
        
    </body>


</html>
