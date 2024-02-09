<?php
include __DIR__ . '/DBModel/modelLink.php';

$results = '';
$uNameError = '';
$uPassError = '';
$rePassError = '';

if (isset($_POST['login'])){
    if (empty($username = filter_input(INPUT_POST, "uName"))){
        $uNameError = "*";
    }
    if (empty($password = filter_input(INPUT_POST, "uPass"))){
        $uPassError = "*";
    }
    if (empty($pass2 = filter_input(INPUT_POST, "rePass", ))){
        $rePassError = "*";
    }
    
    
    

    $user = login($username, crypt($password,'$5$'));
    if (crypt($password, '$5$') == crypt($pass2, '$5$')){
        $results = '';

    }
    else{
        $results = "Your passwords Must match";
    }


}else{
    $username = '';
    $password = '';
    $pass2 = '';
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
            width: 100%;
            position: fixed;
            bottom: 0px;
            margin-top: 55px;
            font-size: 20px;
            font-family: "Inter", sans-serif;
            font-weight: 400;

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
            margin-top: 0px;
        }
        .newAcc{
            margin-top: 30px;
        }
        .errors{
            color: #F81D1D;
            margin-top: 20px;
        }

    </style>
    
</head>
<body>
    <div>
        <div class="row headerrow" style="width:105%;">
            <div class="col-2 text-start">
                <a href="home.php">
                    <img src="images/Link-up_and_Learn_Logo.png" alt="Home" class="logobtn">
                </a>
            </div>
            <div class="col-8 text-center">
                <h1>Link up and Learn</h1>
            </div>
            <div class="col-2 text-center logbtns">
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
                                    <input type="text" name="uName" value="<?=$username; ?>"><?php echo $uNameError; ?>
                                </td>
                                
                                
                            </tr>
                            <tr>
                                <td>
                                    <label for="uPass">Password:</label>
                                </td>
                                <td>
                                    <input type="text" name="uPass" value="<?=$password; ?>"><?php echo $uPassError; ?>
                                </td>
                                
                                
                                
                            </tr>
                            <tr>
                                <td>
                                    <label for="uPass">Re-Enter Password:</label>
                                </td>
                                <td>
                                    <input type="text" name="rePass" value="<?=$pass2; ?>"><?php echo $rePassError; ?>
                                </td>
                                
                                
                                
                            </tr>
                        </table>
                        
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4">
                        
                    </div>
                    <div class="col-4 errors">
                        <p> <?php echo $results; ?></p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4">
                        
                    </div>
                    <div class="col-4">
                        <button name="login" class="custom-btn btn-14">Create</button>
                    </div>
                </div>
            </form>
            
                    


        </div>
        <footer class="card-footer footextra">
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
