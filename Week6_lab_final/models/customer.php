<?php

//patient class gets and sets functions
class Customer
{

    private $id;
    private $customerFirstName;
    private $customerLastName;
    private $customerMarried;
    private $customerBirthDate;

    public function setPatientId($theId)
    {
        $this->id = $theId;
    }

    public function setPatientFirstName($firstName)
    {
        $this->patientFirstName = $firstName;
    }

    public function setPatientLastName($lastName)
    {
        $this->patientLastName = $lastName;
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