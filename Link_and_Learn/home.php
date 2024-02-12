<?php
    session_start();

    include __DIR__ . '/DBModel/modelLink.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link-Up and Learn</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Stylesheets/style.css" type="text/css">
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
            position: absolute;
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

    </style>
    
</head>
<body>
    <div>
        <div class="row headerrow">
            <div class="col-2 text-start">
                <a href="home.php">
                    <img src="images/Link-up_and_Learn_Logo.png" alt="Home" class="logobtn">
                </a>
            </div>
            <div class="col-8 text-center">
                <h1>Link up and Learn</h1>
            </div>
            <div class="col-2 text-center logbtns">
                <?php if(isset($_SESSION['user'])): ?>
                    <h3 class="username"><?= $_SESSION['user']; ?></h3>
                    <a href="Logout.php">
                <button class="custom-btn btn-14 logoutbtn">
                    Logout
                </button>
                </a>
                <?php else: ?>
                    <h3 class="username">Guest</h3>
                <a href="Login.php">
                <button class="custom-btn btn-14 logoutbtn" id="loginbtn">
                    Login
                </button>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <div>

        </div>
        <footer class="row footextra">
            <p>Name:</p>
            <p>Phone:</p>
            <p>Email:</p>
        </footer>

        
        
        
        
    </div>
    <div>

    </div>
    <div>

    </div>
    
    
</body>
</html>