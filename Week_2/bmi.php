<?php

require_once 'bmiDesign.php';

function age ($bdate) {
    $date = new DateTime($bdate);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
 }
 
function isDate($dt) 
{
    $date_arr  = explode('-', $dt);
    return checkdate($date_arr[1], $date_arr[2], $date_arr[0]);
}
 
function bmi ($feet, $inch, $weight) 
{
    // Convert height to meters
    $ht = (($feet * 12) + $inch) * 0.0254;

  // Calculate BMI
    $bmi = $weight / ($ht * $ht);

  // Return BMI value rounded to one decimal place
    return round($bmi, 1);
}


function bmiDescription ($bmi) 
{
    if ($bmi < 18.5) 
    {
        return "Underweight";
    }

    elseif ($bmi >= 18.5 && $bmi <= 24.9) 
    {
        return "Normal weight";
    } 

    elseif ($bmi >= 25.0 && $bmi <= 29.9) 
    {
        return "Overweight";
    }

    else 
    {
        return "Obese";
    }
}
?>


