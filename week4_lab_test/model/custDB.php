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



?>
