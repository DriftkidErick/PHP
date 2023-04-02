<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Welcome To Erick's Tasks of The Day</h1>

    <ul>

        <li>
            <strong>Task: </strong> <?= $task['Title'];?>
        </li>

        <li>
            <strong>Due: </strong> <?= $task['Due'];?>
        </li>

        <li>
            <strong>Assigned To: </strong> <?= $task['Assigned_To'];?>
        </li>

        <li>
            <strong>Task Completed: </strong> 
            <?= $task['Completed']? 'Finished' : 'Not Done'; ?>
        </li>

        <li>
            <strong>Still In Progress: </strong> 

            <?php

                if($task['Working_on_assignment'])
                {
                    echo 'Task is still in progress';
                }

                else
                {
                    echo 'Task in all done';
                }

            ?>
        </li>

        <li>
            <strong>Is Erick Going to Walk The Dog: </strong> 

            <?php

                if($task['Walking_the_dog_later'])
                {
                    echo 'Yes, Erick is going to walk the dog later';
                }

                else
                {
                    echo 'No, Erick will not walk the Dog today as the Dog asked for a day off';
                }

            ?>
        </li>

    </ul>
</body>
</html>