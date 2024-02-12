<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Attempts</title>
</head>

<?php
    include __DIR__ . '/../DBModel/modelLink.php';
    $logattempt = getLoginAttempts();
?>
<body>
    

    <div class="containter">

        <h3>Login Attempts</h3>
        <table class="login_attempts">
            <thead>  
                <tr>
                    <th>Date</th>
                    <th>Username</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($logattempt as $l):?>
                    <tr>
                        <td><?= $l['AttemptTime']?></td>
                        <td><?= $l['username']?></td>
                        <td><?= $l['successful']?></td>
                    </tr>
                <?php endforeach; ?>   
            </tbody> 
        </table>      
    </div>
</body>
</html>