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

        if(isset($_GET['action'])){
            $action = filter_input(INPUT_GET, 'action');
            $userpull = filter_input(INPUT_GET, 'username');

            if($action == "Update"){
                $user = OneUser($userpull);
                $username = $user["username"];
                $logpassword = $user["logpassword"];
                $perm = $user["perm"];
            }
            else{
            $username = "";
            $logpassword = "";
            $perm = "";
            }
        }

    ?>

    <h2>Edit User</h2>

    
    <form name="account" method="post" action="edit_user">
        <div class="wrapper">
            <form method="post" name="editaccont">
                <labl>Username: </label>
                <input type="text" name="username" value="<?= $username;?>" />
                <br>
                <labl>Password: </label>
                <input type="<?=$buttonchange?>" value="Change Password" onclick="inputchange()">

                <input type="<?=$changepass?>" name="logpassword" value="" />
                <br>
                <labl>Role: </label>
                <select id="perm" name="perm" value="<?= $perm;?>">
                    <option value="admin">Admin</option>
                    <option value="owner">Owner</option>
                    <option value="user">User</option>
                </select>
                <div>
                    &nbsp;
                </div>
                <div>
                    <input type="submit" name="Update_User" value="Update_User" />
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
    <?php$changepass = "text";
    $buttonchange = "hidden";?>
   }
</script>
</html>