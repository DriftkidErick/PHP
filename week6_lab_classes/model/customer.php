<?php
//Here i am creating a customer class

class Customer
{
    private $id;
    private $customerFName;
    private $customerLName;
    private $married;
    private $dob;

    public function setCustomerId($theId)
    {
        $this->id = $theId;
    }

    public function setCustomerFName($fName)
    {
        $this->customerFName = $fName;
    }

    public function setCustomerLName($lName)
    {
        $this->customerLName = $lName;
    }

    public function setMarried($status)
    {
        $this->married = $status;
    }

    public function setDOB($dob)
    {
        $this->dob = $dob;

    }
    //*****************************************************************************

    public function getCustomerId()
    {
        return $this->id;
    }

    public function getCustomerFName()
    {
        return $this->customerFName;
    }

    public function getCustomerLName()
    {
        return $this->customerLName;
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