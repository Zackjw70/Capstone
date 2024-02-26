<?php
include __DIR__ . '/DBModel/modelLink.php';

$results = '';

if (isset($_POST['login'])){
    $errorcnt = 0;
    if(empty($username = filter_input(INPUT_POST, "uName"))){
        $errorcnt += 1;
    }
    if(empty($password = filter_input(INPUT_POST, "uPass"))){
        $errorcnt += 1;
    }
    if($errorcnt == 0){
        $user = login($username, $password);

        if(count($user) > 0)
        {
            session_start();
            $_SESSION['user']=$user['username'];
            $_SESSION['perm']=$user['perm'];

            if($_SESSION['perm'] == 2){
                header('location: Admin/User.php');
            }
            elseif($_SESSION['perm'] == 1){
                header('location: Backend/HomeEdit.php');
            }
            else{
                header('location: home.php');
            }
            

            
        }
        else{
            session_unset();
            $results = "Invalid Login!";
        }
    }
    

}else{
    $username = '';
    $password = '';
}


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
            overflow:hidden;

        }
        label, p{
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

            }
            table {
                
                
            }
            .newAcc{
                font-size: 12px;
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
        input, label{
            margin-top: 50px;
            font-size:20px;
        }
        table{
            width: 100%;
            display: flex;
            justify-content: center;
        }
        td{
            padding-left:50px;
        }
        button{
            display: flex;
            justify-content: center;
            align:center;
            margin-top: 50px;
        }
        .newAcc{
            margin-top: 30px;
        }
        .errors{
            color: #F81D1D;
            margin-top: 20px;
        }
        tr{
            width: 100.5%;
            overflow: hidden;
        }
        .row{
            max-width: 100.5%;
        }
        .backbtn{
            margin-top:50px;
            margin-left: 50px;
        }
        

    </style>
    
</head>
<body>
    <div>
        <div class="row headerrow">
            <div class="col-2 text-start">
                <a href="home.php">
                    <img src="images/Link-up_and_Learn_Logo.png" alt="Home" class="logobtn" style="height:150px; width:150px;">
                </a>
            </div>
            <div class="col-8 text-center">
                <h1>Link up and Learn</h1>
            </div>
            <div class="col-2">
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-4">
                      
                </div>
                <div class="col-4 text-center">
                    <h2>Login</h2>
                </div>
            </div>
            <form method="POST">
                <div class="row">
                    <div class="col-4">

                    </div>
                    <div class="col-4 form">
                        <table>
                            <tr>
                                <td>
                                    <label for="uName">Username:</label>
                                </td>
                                <td>
                                    <input type="text" name="uName">
                                </td>
                                
                            </tr>
                            <tr>
                                <td>
                                    <label for="uPass">Password:</label>
                                </td>
                                <td>
                                    <input type="password" name="uPass">
                                </td>
                                
                                
                            </tr>
                        </table>
                        
                    </div>
                </div>
                
                <div class="row text-center">
                    <div class="col-4">

                    </div>
                    <div class="col-4 errors">
                        <p><?= $results; ?></p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4">

                    </div>
                    <div class="col-4 ">
                        <p class="newAcc">Need an account <a href="CreateAccount.php">create!</a> one now</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4">
                        
                    </div>
                    <div class="col-4">
                        <button name="login" class="custom-btn btn-14">Login</button>
                    </div>
                </div>
            </form>
            
                    


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