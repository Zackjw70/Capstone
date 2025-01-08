<?php
include __DIR__ . '/DBModel/modelLink.php';
$info = getmain();
$picture = $info["picture"];

$results = '';
$uNameError = '';
$uPassError = '';
$rePassError = '';
$userResults = '';
$errorcnt = 0;

if (isset($_POST['login'])){
    
    $errorcnt = 0;
    if (empty($username = filter_input(INPUT_POST, "uName"))){
        $uNameError = "*";
        $errorcnt += 1;
    }
    if (empty($password = filter_input(INPUT_POST, "uPass"))){
        $uPassError = "*";
        $errorcnt += 1;
    }
    if (empty($pass2 = filter_input(INPUT_POST, "rePass", ))){
        $rePassError = "*";
        $errorcnt += 1;
    }
    
    if (crypt($password, '$5$') == crypt($pass2, '$5$')){
        $results = '';
        if(!empty($currentUser = OneUser($username))){
            $results = "User already exists!";
            $errorcnt += 1;
            
        }
        elseif($errorcnt == 0){
            addUsers($username, $password, 0);
            header("Location: Login.php");
        }
        else{
            $results = "Must fill in indicated fields!";
        }



    }
    else{
        $results = "Your passwords Must match!";
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
                <div class="col-md-4">
                    <a href="Login.php"><button class="custom-btn btn-14 backbtn">
                    Back</button></a>
                </div>
                <div class="col-md-4 text-center">
                    <h2 class="head2 inputsep">Create Account</h2>
                </div>
            </div>
            <form method="POST">
                <div class="row">
                    <div class="col-md-4 offset-md-4 form">
                        <table>
                            <tr>
                                <td>
                                    <label class="inputsep par" for="uName">Username:</label>
                                </td>
                                <td>
                                    <input class="inputLog inputsep" type="text" name="uName" value="<?=$username; ?>"><?php echo $uNameError; ?>
                                </td>
                                
                                
                            </tr>
                            <tr>
                                <td>
                                    <label class="inputsep par" for="uPass">Password:</label>
                                </td>
                                <td>
                                    <input class="inputLog inputsep" type="text" name="uPass" value="<?=$password; ?>"><?php echo $uPassError; ?>
                                </td>
                                
                                
                                
                            </tr>
                            <tr>
                                <td>
                                    <label class="par xtraBottom" for="uPass">Re-Enter Password:</label>
                                </td>
                                <td>
                                    <input class="inputLog xtraBottom" type="text" name="rePass" value="<?=$pass2; ?>"><?php echo $rePassError; ?>
                                </td>
                                
                                
                                
                            </tr>
                        </table>
                        
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4">
                        
                    </div>
                    <div class="col-4 errors" style="height:20px;margin-bottom:20px; color:red">
                        <p> <?php echo $results; ?></p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4">
                        
                    </div>
                    <div class="col-4">
                        <button name="login" class="custom-btn btn-14" style="margin-bottom:58px;">Create</button>
                    </div>
                </div>
            </form>
            
                    


        </div>
        <footer class="card-footer footextra">
            <?php include 'includes/footer.php';?>
        </footer>
    </div>
    
 
</body>
</html>
