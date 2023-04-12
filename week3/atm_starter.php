
<?php

require_once 'checking.php';
require_once 'savings.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') //This checks if its a post req
    {
        //Checking account variables stores on post
        echo "<h1>POST METHOD</h1>"; //LOADS AFTER BUTTONS ARE CLICKED
        var_dump($_POST);
        $checkingID = filter_input(INPUT_POST, 'checkingID');
        $checkingBal = filter_input(INPUT_POST, 'checkingBal', FILTER_VALIDATE_FLOAT);
        $checkingSD = filter_input(INPUT_POST, 'checkingSD');

        //Savings account stores on post
        $savingID = filter_input(INPUT_POST, 'savingID');
        $savingsBal = filter_input(INPUT_POST, 'savingBal', FILTER_VALIDATE_FLOAT);
        $savingSD = filter_input(INPUT_POST, 'savingSD');

    }

    else
    {
        echo "<h1>Not a post</h1>"; //LOADS ON INITIAL START
        
        //creating base vars for checkings
        $checkingID = "C123";
        $checkingBal = 1000;
        $checkingSD = '12-20-2019';

        //base vars for Savings
        $savingID = "S123";
        $savingsBal = 5000;
        $savingSD = '03-20-2020';
        

    }

    //create a new instance of checking and saving
    $checkings = new CheckingAccount($checkingID, $checkingBal, $checkingSD);
    $savings = new SavingsAccount($savingID, $savingsBal, $savingSD);

    if (isset ($_POST['withdrawChecking'])) 
    {
        echo "I pressed the checking withdrawal button";
        $checkings -> withdrawal(filter_input(INPUT_POST,'checkingWithdrawAmount'));

    } 
    else if (isset ($_POST['depositChecking'])) 
    {
        echo "I pressed the checking deposit button";
        $checkings -> deposit(filter_input(INPUT_POST,"checkingDepositAmount"));
    } 
    else if (isset ($_POST['withdrawSavings'])) 
    {
        echo "I pressed the savings withdrawal button";
    } 
    else if (isset ($_POST['depositSavings'])) 
    {
        echo "I pressed the savings deposit button";
    } 


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
    <style type="text/css">
        body {
            margin-left: 120px;
            margin-top: 50px;
        }
       .wrapper {
            display: grid;
            grid-template-columns: 300px 300px;
        }
        .account {
            border: 1px solid black;
            padding: 10px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        label {
           font-weight: bold;
        }
        input[type=text] {width: 80px;}
        .error {color: red;}
        .accountInner {
            margin-left:10px;margin-top:10px;
        }
    </style>
</head>
<body>

    <form method="post">
               
    <h1>ATM</h1>
        <div class="wrapper">
            
            <div class="account">
              
                    <?= $checkings -> getAccountDetails() ?>


                        <input type="hidden" name="checkingID" value=<?= $checkings-> getAccountId()?>>
                        <input type="hidden" name="checkingBal" value=<?= $checkings-> getBalance()?>>
                        <input type="hidden" name="checkingSD" value=<?= $checkings -> getStartDate() ?>>


                    <div class="accountInner">
                        <input type="text" name="checkingWithdrawAmount" value="" />
                        <input type="submit" name="withdrawChecking" value="Withdraw" />
                    </div>
                    <div class="accountInner">
                        <input type="text" name="checkingDepositAmount" value="" />
                        <input type="submit" name="depositChecking" value="Deposit" /><br />
                    </div>
            
            </div>

            <div class="account">

                    <?= $savings -> getAccountDetails() ?>

                        <input type="hidden" name="savingID" value="S123">
                        <input type="hidden" name="savingBal" value="5000">
                        <input type="hidden" name="savingSD" value="03-20-2020">

                    
               
                    
                    <div class="accountInner">

                        <input type="text" name="savingsWithdrawAmount" value="" />
                        <input type="submit" name="withdrawSavings" value="Withdraw" />
                    </div>
                    <div class="accountInner">
                        <input type="text" name="savingsDepositAmount" value="" />
                        <input type="submit" name="depositSavings" value="Deposit" /><br />
                    </div>
            
            </div>
            
        </div>
    </form>
</body>
</html>
