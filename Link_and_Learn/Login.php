<?php
include __DIR__ . '/DBModel/modelLink.php';
$info = getmain();
$picture = $info["picture"];

$results = '';
$error = "";

if (isset($_POST['login'])){
    
    $errorcnt = 0;
    if(empty($username = filter_input(INPUT_POST, "uName"))){
        $errorcnt += 1;
        $error .= "<li>Please provide a username </li>";
    }
    if(empty($password = filter_input(INPUT_POST, "uPass"))){
        $errorcnt += 1;
        $error .= "<li>Please provide a password</li>";
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
            $errorcnt += 1;
            $results = "Invalid Login!";
            $error .= "<li>Please Try Again</li>";
        }
        
    }
    else{
        session_unset();
        $results = "Invalid Login!";
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
        .row{
            width:100%;
        }
    </style>
    
</head>
<body class="everyThang">
    <div>
    <div class="headerrow row m-0">
        <div class="col-sm-1 text-start" style="padding-left:0px;">
            <a href="home.php">
                <img src="<?= $picture?>" alt="Home" class="logobtn" style="height:90px; width:90px;">
            </a>
        </div>
        <div class="col-lg-8 col-md-6 text-left">
            <h1 class="head1">Link up and Learn</h1>
        </div>
    </div>    
        <div>
            <div class="row">
                <div class="col-4">
                      
                </div>
                <div class="col-4 text-center">
                    <h2 class="head2" style="margin-bottom:100px;">Login</h2>
                </div>
            </div>
            <form method="POST">
                <div class="row">
                    <div class="col-md-4 offset-md-5 form">
                        <table>
                            <tr>
                                <td>
                                    <label class="inputsep par" for="uName">Username:</label>
                                </td>
                                <td>
                                    <input type="text" name="uName" class="inputLog inputsep">
                                </td>
                                
                            </tr>
                            <tr class="">
                                <td>
                                    <label class="inputsep par" for="uPass">Password:</label>
                                </td>
                                <td>
                                    <input type="password" name="uPass" class="inputLog inputsep">
                                </td>
                                
                                
                            </tr>
                        </table>
                        
                    </div>
                </div>
                
                <div class="row text-center">
                    <div class="col-4">

                    </div>
                    <div class="col-4" style="color:red;height:20px;margin-bottom:15px;">
                        <p><?= $results; ?></p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4 row text-center">
                        <ul>
                            <?=$error?>
                        </ul>
                    </div>

                    <br>
                    <div class="col-4 row text-center">
                        <p class="newAcc">Need an account <a href="CreateAccount.php">create!</a> one now</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4">
                        
                    </div>
                    <div class="col-4">
                        <button name="login" class="custom-btn btn-14 inputsep">Login</button>
                    </div>
                </div>
            </form>
            
                    


        </div>
        <footer>
            <?php include 'includes/footer.php';?>
        </footer>

    </div>
    
    
</body>
</html>