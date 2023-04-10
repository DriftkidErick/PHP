<?php
    include __DIR__ . '/../include//header.php'
?>

<?php

//  Requirements
    //Display the numbers 1 through 100 except in the following cases:
    //Display fizz if the number a multiple of 2,
    //Display buzz if the number a multiple of 3
    //Display fizz buzz if the number is a multiple of both two and three.
    //Your solution must include a for-loop that calls a function fizzBuzz.

    function fizzBuzz($num)
    {
        if ($num % 2 == 0 && $num % 3 == 0) //If num is divisable by 2 and 3 
        {
            return "fizzbuzz";
        }

        elseif ($num % 2 == 0) //If num is divisable by 2 print fizz
        {
            return "fizz";
        }

        elseif ($num % 3 == 0) //If num is divisable by 3 print buzz
        {
            return "buzz";
        }

        else            //If the number being displayed is not divisable by 2 or 3 return the number
        {
            return $num;
        }
    };

    require_once 'fizzbuzzDesign.php';
?>

<?php include __DIR__ . '/../include/footer.php'; ?>

