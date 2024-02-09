<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Stylesheets/style.css" type="text/css">
  <title>User Edit</title>
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
        

        if(isset($_GET['action'])){
            $action = filter_input(INPUT_GET, 'action');
            $userpull = filter_input(INPUT_GET, 'username');

            if($action == "Update"){
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

            else{
            $username = "";
            $logpassword = "";
            $perm = "";
            
            }
        }

        if(isset($_POST['Update_User'])){
            $username = filter_input(INPUT_POST, 'username');
            if(filter_input(INPUT_POST, 'logpassword') == ""){
                $logpassword = filter_input(INPUT_POST, 'CurrentPassword');
            }
            else{
                $logpassword = filter_input(INPUT_POST, 'logpassword');
            }
            
            $perm = filter_input(INPUT_POST, 'perm');

            if ($error == ""){
                UpdateUser($username, $logpassword, $perm);
                header('Location: User.php');
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

    ?>

    <h2>Edit User</h2>

    
    <form name="account" method="post" action="UserEdit.php">
        <div class="wrapper">
            <form method="post" name="editaccont">
                <labl>Username: </label>
                <input type="text" name="username" value="<?= $username;?>" readonly />
                <br>
                <labl>Password: </label>
                <input id="passchangebutton" type="button" value="ChangePassword" onclick="inputchange()">

                <input id="currentpassword" type="hidden" value="CurrentPassword" value="<?=$logpassword?>">

                <input id="passchangetext" type="hidden" name="logpassword" onclick="inputchange()" value="" />
                <br>
                <labl>Role: </label>
                <select id="perm" name="perm" value="<?=$perm?>">
                    <option value="2">Admin</option>
                    <option value="1">Owner</option>
                    <option value="0">User</option>
                </select>
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
    
    
</body>
<script>
   function inputchange()  {
    document.getElementById("passchangebutton").type = "hidden";
    document.getElementById("passchangetext").type = "text";
   }
</script>
</html>