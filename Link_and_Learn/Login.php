<?php
include __DIR__ . '/DBModel/modelLink.php';

if (isset($_POST['login'])){
    $username = filter_input(INPUT_POST, "uName");
    $password = filter_input(INPUT_POST, "uPass");

    $user = login($username, $password);

    var_dump($user);
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
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="uName">
        <input type="text" name="uPass">
        <input type="submit" name="login" value="login">
    </form>
    
</body>
</html>