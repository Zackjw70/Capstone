<?php

$info = getmain();
$title = $info["title"];

?>

<div class="row headerrow">
        <div class="col-2 text-start">
            <h2>Admin</h2>
        </div>
        <div class="col-8 text-center">
            <h1><?=$title?></h1>
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
        <div class="row headrow text-center" style="margin-top: 80px">
         
            <div class="col-md-2 offset-md-1">    
            <a href="../home.php" class="aButtons">Home Page</a>
            </div>
            <div class="col-md-2 ">   
            <a href="../Backend/HomeEdit.php" class="aButtons">Edit Home Page</a>
            </div>
            <div class="col-md-2 ">
            <a href="user.php" class="aButtons">Users</a>
            </div>
            <div class="col-md-2 ">
            <a href="loginattempts.php" class="aButtons">Log Attempts</a>
            </div>
            <div class="col-md-2 ">
            <a href="changeLog.php" class="aButtons">ChangeLog</a>
            </div>
        </div>
        
</div>