<?php 
    include __DIR__ . '/../DBModel/modelLink.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Attempts</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../Stylesheets/style.css" type="text/css">
    <script src="https://cdn.tiny.cloud/1/vq1rq2p69wax28njpht11pigfyry07aksn56iwrrgnkrhe3x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        .row{
            width:100%;
        }
    </style>
</head>

<?php

    session_start();
    if(!isset($_SESSION['user']) && $_SESSION['perm'] < 2){
        header ('Location: ../Login.php');
    }

    $logattempt = getLoginAttempts();



    if(isset($_POST['searchname'])){
        $username = filter_input(INPUT_POST, 'username');
        $searchlog = searchLoginAttempts($username);
    }

    
?>
<body class="everyThang">

    <?php include '../includes/adminheader.php'; ?>
    

    <div class="row text-center" style="margin-top:20px">
        <h2>Login Attempts</h2>
    </div>
    <div class="row text-center">
        <div class="searchcontainter">

            <div class="d-flex justify-content-center">
                <form method="post" name="searchlog">
                    <label>Username:</label>
                    <input type="text" name="username" value="" />

                    <input type="submit" name="searchname" value="Search Name" />
                    <input type="submit" name="showall" value="Show All" />
                </form>
            </div>

            <div class="d-flex justify-content-center">
            <table class="table table-striped table-warning" style="width: auto;">
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
                                <?php if($l['successful'] == "Pass"): ?>
                                    <td style="color:#2AAE2F">
                                        Pass
                                    </td>
                                <?php else:?>
                                    <td style="color:#F81D1D">
                                        Fail
                                    </td>
                                <?php endif;?>
                            </tr>
                        <?php endforeach; 
                    } elseif(isset($_POST['showall'])){
                        foreach ($logattempt as $a):?>
                            <tr>
                                <td><?= $a['AttemptTime']?></td>
                                <td><?= $a['username']?></td>
                                <?php if($a['successful'] == "Pass"): ?>
                                    <td style="color:#2AAE2F">
                                        Pass
                                    </td>
                                <?php else:?>
                                    <td style="color:#F81D1D">
                                        Fail
                                    </td>
                                <?php endif;?>
                            </tr>
                        <?php endforeach; 
                    }else{
                        foreach ($logattempt as $a):?>
                            <tr>
                                <td><?= $a['AttemptTime']?></td>
                                <td><?= $a['username']?></td>
                                <?php if($a['successful'] == "Pass"): ?>
                                    <td style="color:#2AAE2F">
                                        Pass
                                    </td>
                                <?php else:?>
                                    <td style="color:#F81D1D">
                                        Fail
                                    </td>
                                <?php endif;?>
                            </tr>
                        <?php endforeach; 
                    }?>
                </tbody> 
            </table>
            </div>      
        </div>
    </div>
</body>
</html>