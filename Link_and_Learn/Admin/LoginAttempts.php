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



    if(isset($_POST['searchname'])){
        $username = filter_input(INPUT_POST, 'username');
        $searchlog = searchLoginAttempts($username);
    }
?>
<body>
    
    <h3>Login Attempts</h3>
    <div class="searchcontainter">

        <div class="searchwrapper">
            <form method="post" name="searchlog">
                <label>Username:</label>
                <input type="text" name="username" value="" />

                <input type="submit" name="searchname" value="Search Name" />
                <input type="submit" name="showall" value="Show All" />
            </form>
        </div>

        
        <table class="login_attempts">
            <thead>  
                <tr>
                    <th>Date</th>
                    <th>Username</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <?php if(isset($_POST['searchname'])){
                        foreach ($searchlog as $l):?>
                        <tr>
                            <td><?= $l['AttemptTime']?></td>
                            <td><?= $l['username']?></td>
                            <td><?= $l['successful']?></td>
                        </tr>
                    <?php endforeach; 
                } elseif(isset($_POST['showall'])){
                    foreach ($logattempt as $a):?>
                        <tr>
                            <td><?= $a['AttemptTime']?></td>
                            <td><?= $a['username']?></td>
                            <td><?= $a['successful']?></td>
                        </tr>
                    <?php endforeach; 
                }else{
                    foreach ($logattempt as $a):?>
                        <tr>
                            <td><?= $a['AttemptTime']?></td>
                            <td><?= $a['username']?></td>
                            <td><?= $a['successful']?></td>
                        </tr>
                    <?php endforeach; 
                }?>
            </tbody> 
        </table>      
    </div>
</body>
</html>