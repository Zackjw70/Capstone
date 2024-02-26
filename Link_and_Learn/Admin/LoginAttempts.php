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
        body{
            background-color:#EAD064;
        }
        h1{
            font-family: "Architects Daughter", cursive;
            font-weight: 400;
            font-style: normal;
            height: 50px;
            color:#B93836;
            font-size:60px;
            margin-left:auto;margin-right:auto;
            margin-top:50px;
            
        }
        .footextra{
            background-color:#EABC64;
            position: relative;
            bottom: 0;
            width: 100.5%;
            padding-top:10px;
            font-size: 20px;
            font-family: "Inter", sans-serif;
            font-weight: 400;

        }
        .loginbtn{
            margin-top:80px;
            width: 200px;
            height: 60px;
            font-size:26px;
            margin-right: 50%;

        }
        .logoutbtn{
            width: 200px;
            height: 60px;
            font-size:26px;
        }
        .username{
            margin-top:20px;
            max-height: 30px;
            font-size:26px;
            margin-right: 50%;
            width:100%;
            overflow: hidden;
            
        }
        .headerrow{
            background-color:#EABC64;
            width:100.5%;
            overflow: hidden;
        }
        .logobtn{
            opacity: 50%;
        }
        @media only screen and (max-width: 1000px) {
            h1{
                margin-left: 200px;
                font-size:45px;   
            }
            .logbtns{
                display:block;
                width: 100%;
                height: 150px;
            }
            .username{
                display:block;
                margin-bottom:30px;
                width: 100%;
            }
        
        }
        h2{
            font-family: "Architects Daughter", cursive;
            font-weight: 400;
            font-style: normal;
            color:#B93836;
            font-size:50px;
            margin-top:50px;
        }
        .row{
            max-width: 100.5%;
        }
        textarea{
            padding-top:30px;
            padding-bottom:30px;
        }
        .hiddenitems{
            display: none;
        }
        .d-flex{
            margin-bottom: 10px;
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
<body>

    <div class="row headerrow">
        <div class="col-2 text-start">
            <h2>Admin</h2>
        </div>
        <div class="col-8 text-center">
            <h1>Link up and Learn</h1>
        </div>
        <div class="col-2 text-center logbtns">
            <?php if(isset($_SESSION['user'])): ?>
                <h3 class="username"><?= $_SESSION['user']; ?></h3>
                <a href="../Logout.php">
            <button class="custom-btn btn-14 logoutbtn">
                Logout
            </button>
            </a>
            <?php else: ?>
                <h3 class="username">Guest</h3>
            <a href="../Login.php">
            <button class="custom-btn btn-14 logoutbtn" id="loginbtn">
                Login
            </button>
            </a>
            <?php endif; ?>
            
        </div>
        <div class="d-flex justify-content-evenly" style="margin-top: 20px">
            <a href="../home.php">Home Page</a>
            <a href="../Backend/HomeEdit.php">Edit Home Page</a>
            <a href="user.php">Users</a>
            <a href="loginattempts.php">Log Attempts</a>
            <a href="changeLog.php">ChangeLog</a>
        </div>
        
    </div>
    

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