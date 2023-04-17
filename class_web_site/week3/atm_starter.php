
<?php

include __DIR__ . '/../include//header.php'; //INCLUDES THE HEADER BY TIM HENRY

// This calls the checking and saving pages
require_once 'checking.php';
require_once 'savings.php';
require_once 'function.php';

//$_SERVER['REQUEST_METHOD'] === 'POST'
    if(isPostRequest()) //This checks if its a post request/ when the buttons are cli
    {
        //Checking account variables stores on post
        $checkingID = filter_input(INPUT_POST, 'checkingID');
        $checkingBal = filter_input(INPUT_POST, 'checkingBal', FILTER_VALIDATE_FLOAT);
        $checkingSD = filter_input(INPUT_POST, 'checkingSD');

        //Savings account stores on post
        $savingID = filter_input(INPUT_POST, 'savingID');
        $savingsBal = filter_input(INPUT_POST, 'savingBal', FILTER_VALIDATE_FLOAT);
        $savingSD = filter_input(INPUT_POST, 'savingSD');

    }

    else //IF the server is a get / ON inital load this is whats loaded
    {   
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

    //Actions are made after a button is clicked
    if (isset ($_POST['withdrawChecking'])) 
    {
        // This calls the withdrawl method from the checkings page
        $checkings -> withdrawal(filter_input(INPUT_POST,'checkingWithdrawAmount',FILTER_VALIDATE_FLOAT));

    } 
    else if (isset ($_POST['depositChecking'])) 
    {
        //This calls the deposit method from the checkings object
        $checkings -> deposit(filter_input(INPUT_POST,"checkingDepositAmount",FILTER_VALIDATE_FLOAT));
    } 
    else if (isset ($_POST['withdrawSavings'])) 
    {
        // This calls the withdrawl method from the saving page
        $savings -> withdrawal(filter_input(INPUT_POST, "savingsWithdrawAmount",FILTER_VALIDATE_FLOAT));
    } 
    else if (isset ($_POST['depositSavings'])) 
    {
        // This calls the withdrawl method from the savings object
        $savings -> deposit(filter_input(INPUT_POST, "savingsDepositAmount", FILTER_VALIDATE_FLOAT));
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
              
                    <!-- This calls function that gets account details -->
                    <?= $checkings -> getAccountDetails() ?> 

                        <!-- These are saved values after clicking the post -->
                        <input type="hidden" name="checkingID" value=<?= $checkings-> getAccountId()?>>
                        <input type="hidden" name="checkingBal" value=<?= $checkings-> getBalance() ?>>
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

                    <!-- This calls the account details -->
                    <?= $savings -> getAccountDetails() ?>

                        <!-- These are saved values after clicking the post -->
                        <input type="hidden" name="savingID" value= <?= $savings -> getAccountId() ?>>
                        <input type="hidden" name="savingBal" value= <?= $savings -> getBalance() ?>>
                        <input type="hidden" name="savingSD" value= <?= $savings -> getStartDate()?>>

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

    <?php include __DIR__ . '/../include/footer.php'; //Included footer by TIM HENRY ?> 
</body>
</html>
