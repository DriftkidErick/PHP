<?php

//load libraries first

//Place Initialization code here
$myVar1 = 10;
$myVar2 = "10";

const LOOP_LIMIT = 10;
define("ANOTHER_CONSTANT", 100);

//Other code goes here
if ($myVar1 === $myVar2) // == WILL SAY THEY ARE THE SAME === WILL SAY THEY ARE DIFFERENT BECAUSE OF THEIR DIFFERENT TYPES
{
    echo "They are equal!<br />";
}

else 
{
    echo "They are not the same<br />";    
}



?>

<html>

    <head>

    </head>

    <body>
        <?php
            if ($myVar1 == $myVar2):
        ?>
            They are equal <br />
            <p>This has multiple lines </p>

        <?php else: ?>
            <p>Something else </p>  

        <?php endif; ?>    


        <?php
            $index = 0;
            while($index < LOOP_LIMIT)
            {
                echo "The number is " . $index . " of ". LOOP_LIMIT . "!<br/>";
                $index++;
            }

        ?>

    </body>

</html>