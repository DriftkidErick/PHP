<?php

//patient class gets and sets functions
class Patient
{
    //private vars named of SQL table
    private $id;
    private $patientFirstName;
    private $patientLastName;
    private $patientMarried;
    private $patientBirthDate;

    public function setPatientId($theId)
    {
        $this->id = $theId;
    }

    public function setPatientFirstName($fName)
    {
        $this->patientFirstName = $fName;
    }

    public function setPatientLastName($lName)
    {
        $this->patientLastName = $lName;
    }

    public function setPatientMarried($status)
    {
        $this->patientMarried = $status;
    }

    public function setPatientBirthDate($dob)
    {
        $this->patientBirthDate = $dob;

    }
    //*****************************************************************************

    public function getPatientId()
    {
        return $this->id;
    }

    public function getPatientFirstName()
    {
        return $this->patientFirstName;
    }

    public function getPatientLastName()
    {
        return $this->patientLastName;
    }

    public function getPatientMarried()
    {
        return $this->patientMarried;
    }

    public function getPatientBirthDate()
    {
        return $this->patientBirthDate;
    }
}

?>