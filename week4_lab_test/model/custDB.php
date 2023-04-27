<?php

include (__DIR__ . '/Db.php'); 

function getCustomer()
{
    global $db; //references the Db in db

    $results = [];

    $stmt = $db->prepare("SELECT * from patients");

    if ($stmt-> execute() && $stmt->rowCount() > 0)
    {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);      
    }

    return $results;
    
}

function deleteCust($id)
{
    global $db;

    $results = "Error Not deleted";

    $stmt = $db->prepare("DELETE FROM patients WHERE id=:id");

    $stmt->bindValue(":id", $id);

    if ($stmt-> execute() && $stmt->rowCount() > 0)
    {
        $results = "Data Deleted";
    }

    return $results;

}

function updateCust($id, $fName,$lName,$dob,$married)
{
    global $db;

    $results = "Update did not work";

    $stmt = $db->prepare("UPDATE patients SET patientFirstName = :fNameParam, patientLastName = :lNameParam, patientBirthDate = :dobParam, patientMarried = :marriedParam WHERE id = :idParam");

    $stmt -> bindValue(':idParam', $id);
    $stmt -> bindValue('fNameParam', $fName);
    $stmt -> bindValue('lNameParam', $lName);
    $stmt -> bindValue('dobParam', $dob);
    $stmt -> bindValue('marriedParam', $married);

    if ($stmt-> execute() && $stmt->rowCount() > 0)
    {
        $results = "Data Updated";
    }

    echo $results;
    return $results;
}

function getOneCustomer($id)
{
    global $db; //references the Db in db

    $results = [];

    $stmt = $db->prepare("SELECT * from patients WHERE id= :id");

   
    $stmt -> bindValue(':id', $id);

    if ($stmt-> execute() && $stmt->rowCount() > 0)
    {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);      
    }

    return $results;
    
}

function addCust( $fName,$lName,$dob,$married)
{
    global $db;

    $results = "Add Did not execute";

    $stmt = $db->prepare("INSERT INTO patients SET patientFirstName = :fNameParam, patientLastName = :lnameParam, patientBirthDate = :dobParam,  patientMarried = :marriedParam");

     //Bind query parameters to method parameter values
     $stmt->bindValue(':fNameParam', $fName);
     $stmt->bindValue(':lnameParam', $lName);
     $stmt->bindValue(':dobParam', $dob);
     $stmt->bindValue(':marriedParam', $married);

     if ($stmt-> execute() && $stmt->rowCount() > 0)
     {
        $results = "Added new patient";
     }

     return $results;

}

?>
