<?php

class Cust
{

    private $id;
    private $fName;
    private $lName;
    private $dob;
    private $age;
    private $married;

    public function setCustID($theId)
    {
        $this->id = $theId;
    }

    public function setCustFname($theFname)
    {
        $this->fName= $theFname;
    }

    public function setCustLName($theLName)
    {
        $this -> lName = $theLName;
    }

    public function setDOB($theDob)
    {
        $this->dob = $theDob;
    }

    public function setAge($theAge) //Create an age function
    {
        $this->age = $theAge;
    }

    public function setMarriage($theMarriage)
    {
        $this->married = $theMarriage;
    }

    //Start of gets
    public function getCustID()
    {
        return $this->id;
    }

    public function getCustFname()
    {
        return $this->fName;
    }

    public function getCustLName()
    {
        return $this -> lName;
    }

    public function getDOB()
    {
        return $this->dob;
    }

    public function getAge() //Create an age function
    {
        return $this->age;
    }

    public function getMarriage()
    {
        return $this->married;
    }

}

?>