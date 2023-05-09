<?php

class Patient
{

    private $id;
    private $patientFName;
    private $patientLName;
    private $married;
    private $dob;

    public function setPatientId($theId)
    {
        $this->id = $theId;
    }

    public function setPatientFName($fName)
    {
        $this->patientFName = $fName;
    }

    public function setPateintLName($lName)
    {
        $this->patientLName = $lName;
    }

    public function setDob($bday)
    {
        $this->dob = $bday;
    }

    public function married($status)
    {
        $this->married = $status;
    }


    //////////GETs STARTS HERE////////////////////////

    public function getPatientId()
    {
        return $this->id;
    }

    public function getPatientFName()
    {
        return $this->patientFName;
    }

    public function getPatientLName()
    {
        return $this->patientLName;
    }

    public function getMarried()
    {
        return $this->married;
    }

    public function getDOB()
    {
        return $this->dob;
    }

}

?>