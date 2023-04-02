<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1 style="text-align: center ;">Welcome to Mini Task D</h1>

    <p>Here is some information about the task</p>

    <ul>

        <?php foreach ($taskList as $key => $val) : ?>
        
            <li><strong> <?php echo "$key"; ?></strong> <?php echo "$val"; ?> </li>

        <?php endforeach; ?>


    </ul>

</body>
</html>