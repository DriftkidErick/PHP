<?php

class Patient
{

    private $id;
    private $patientFirstName;
    private $patientLastName;
    private $patientMarried;
    private $patientBrithDate;

    public function setPatientId($theId)
    {
        $this->id = $theId;
    }

    public function setPatientFName($fName)
    {
        $this->patientFirstName = $fName;
    }

    public function setPateintLName($lName)
    {
        $this->patientLastName = $lName;
    }

    public function setDob($bday)
    {
        $this->patientBrithDate = $bday;
    }

    public function married($status)
    {
        $this->patientMarried = $status;
    }


    //////////GETs STARTS HERE////////////////////////

    public function getPatientId()
    {
        return $this->id;
    }

    public function getPatientFName()
    {
        return $this->patientFirstName;
    }

    public function getPatientLName()
    {
        return $this->patientLastName;
    }

    public function getMarried()
    {
        return $this->patientMarried;
    }

    public function getDOB()
    {
        return $this->patientBrithDate;
    }

}

?>