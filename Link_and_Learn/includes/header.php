<?php 
$info = getmain();
$title = $info['title'];
$picture = $info["picture"];
?>

<div class="row headerrow">
            <div class="col-md-2 text-start">
                <a href="home.php">
                    <img src="<?= $picture?>" alt="Home" class="logobtn" style="height:150px; width:150px;">
                </a>
            </div>
            <div class="col-md-8 text-center">
                <h1 class="head1"><?=$title?></h1>
            </div>
            <div class="col-md-2 text-center logbtns">
                <?php if(isset($_SESSION['user'])): ?>
                    <h3 class="username head3"><?= $_SESSION['user']; ?></h3>
                    <a href="Logout.php">
                <button class="custom-btn btn-14 logoutbtn">
                    Logout
                </button>
                </a>
                <?php else: ?>
                    <h3 class="username head3">Guest</h3>
                <a href="Login.php">
                <button class="custom-btn btn-14 logoutbtn" id="loginbtn">
                    Login
                </button>
                </a>
                <?php endif; ?>
            </div>
                <?php if(isset($_SESSION['user']) && $_SESSION['perm'] >= 1 ):?>
                    
                    <div class="text-end">
                        <a href="backend/HomeEdit.php" class="aButtons">Backend</a>
                    </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['user']) && $_SESSION['perm'] >= 2 ):?>
                    
                    <div class="text-end">
                        <a href="admin/user.php" class="aButtons">Admin</a>
                    </div>
                <?php endif; ?>
            
            
            </div>
</div>