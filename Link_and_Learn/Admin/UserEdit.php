<?php 
session_start();
if(!isset($_SESSION['user']) && $_SESSION['perm'] < 2){
    header ('Location: ../Login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../Stylesheets/style.css" type="text/css">
    <script src="https://cdn.tiny.cloud/1/vq1rq2p69wax28njpht11pigfyry07aksn56iwrrgnkrhe3x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <title>User Edit</title>
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
        .spacing{
            margin-bottom: 20px;
        }
        .d-flex{
            margin-bottom: 10px;
        }
        p{
            line-height: 1.5;
            font-family: "Lato";
            font-size: 20px;
        }
        .aButtons{
            text-decoration:none;
            color:#B93836;
            font-family: "Architects Daughter", cursive;
            font-weight: 400;
            font-style: normal;
            font-size:30px;
        }
        .aButtons:hover{
            color:black;
        }
        label {
        display: inline-block;
        width: 100px;
        
        }

    </style>
</head>
<body>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include __DIR__ . '/../DBModel/modelLink.php';
        
        $error = "";
        $changepass = "hidden";
        $buttonchange = "button";
        $inputname = "Add_User";
        $username = "";
        $logpassword = "";
        $perm = "";
        $readonly = "";
        

        if(isset($_GET['action'])){
            $action = filter_input(INPUT_GET, 'action');
            $userpull = filter_input(INPUT_GET, 'username');
            


            if($action == "Update"){
                $readonly = "readonly";
                $user = OneUser($userpull);
                $username = $user["username"];
                $logpassword = $user["logpassword"];
                $perm = $user["perm"];
                $inputname = "Update_User";
                

                if ($perm == '2'){
                    $perm = "Admin";
                }

                if ($perm == '1'){
                    $perm = "Owner";
                }

                if ($perm == '0'){
                    $perm = "User";
                }
                
            }

            if($action == "Delete"){
                $readonly = "readonly";
                $user = OneUser($userpull);
                $username = $user["username"];
                $logpassword = $user["logpassword"];
                $perm = $user["perm"];
                $inputname = "Delete_User";

                if ($perm == '2'){
                    $perm = "Admin";
                }

                if ($perm == '1'){
                    $perm = "Owner";
                }

                if ($perm == '0'){
                    $perm = "User";
                }
                
            }


        }

        if(isset($_POST['Update_User'])){
            $username = filter_input(INPUT_POST, 'username');
            if(filter_input(INPUT_POST, 'logpassword') == ""){
                $perm = filter_input(INPUT_POST, 'perm');
                
                if ($error == ""){
                    NoEncryptUpdate($username, $perm);
                    header('Location: User.php');
                }
            }
            else{
                $logpassword = crypt(filter_input(INPUT_POST, 'logpassword'), '$5$');
                $perm = filter_input(INPUT_POST, 'perm');

                if ($error == ""){
                    UpdateUser($username, $logpassword, $perm);
                    header('Location: User.php');
                }
                
            }
            
            

            
        }

        elseif(isset($_POST['Add_User'])){
            $username = filter_input(INPUT_POST, 'username');
            $logpassword = filter_input(INPUT_POST, 'logpassword');
            $perm = filter_input(INPUT_POST, 'perm');

            if ($error == ""){
                addUsers($username, $logpassword, $perm);
                header('Location: user.php');
            }
        }

        elseif(isset($_POST['Delete_User'])){
            $username = filter_input(INPUT_POST, 'username');
            DeleteUser($username);
            header('Location: user.php');
        }

        //var_dump($action);
        //var_dump($userpull);
        //var_dump($username);

        

    ?>

    <?php include '../includes/adminheader.php'; ?>

    

    <div class="row text-center justify-content-center">
    <h2>Edit User</h2>
    <form name="account" method="post" action="UserEdit.php">
        <div class="wrapper">
            <form method="post" name="editaccont">
                <div class="spacing">
                <label>Username: </label>
                <input type="text" name="username" value="<?php echo $username?>" <?=$readonly?> >
                <br>
                </div>
                <div class="spacing">
                <label>Password: </label>
                <input id="passchangebutton" type="button" value="ChangePassword" onclick="inputchange()">

                <input id="passchangetext" type="hidden" name="logpassword" onclick="inputchange()" value="" />
                <br>
                </div>
                <div class="spacing">
                <label>Role: </label>
                <select id="perm" name="perm">
                    <option value="2" <?php if ($perm == 'Admin') echo "selected"; ?> >Admin</option>
                    <option value="1" <?php if ($perm == 'Owner') echo "selected"; ?>>Owner</option>
                    <option value="0" <?php if ($perm == 'User') echo "selected"; ?>>User</option>
                </select>
                </div>
                <div>
                    &nbsp;
                </div>
                <div>
                    <input type="submit" name="<?=$inputname?>" value="<?=$inputname?>" />
                </div>
                <div>
                    &nbsp;
                </div>
            </form>
        </div>
        <br>
        <a href="user.php">Back to Users</a>
        <ul>
            <?= $error ?>
        </ul>
    </form>
    </div>
    
</body>
<script>
   function inputchange()  {
    document.getElementById("passchangebutton").type = "hidden";
    document.getElementById("passchangetext").type = "text";
   }
</script>
</html>