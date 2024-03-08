<?php 
$info = getmain();
$title = $info['title'];
$picture = $info["picture"];
?>
<style>
    
</style>
<div><div class="headerrow row m-0">
            <div class="col-sm-1 text-start" style="padding-left:0px;">
                <a href="home.php">
                    <img src="<?= $picture?>" alt="Home" class="logobtn" style="height:90px; width:90px;">
                </a>
            </div>
            <div class="col-lg-8 col-md-6 text-left">
                <h1 class="head1"><?= $title; ?></h1>
            </div>
            <div class="col-md-2 text-center logbtns">
                <?php if(isset($_SESSION['user'])): ?>
                    <h3 class="username head3"><?= $_SESSION['user']; ?></h3>
                <?php else:?>
                    <h3 class="username head3">Guest</h3>
                <?php endif;?>
            </div>
            <div class="col-lg-1 text-center logbtns col-md-2 col-sm-1">
                <?php if(isset($_SESSION['user'])): ?>
                    <a href="Logout.php">
                    <button class="custom-btn btn-14 logoutbtn">
                        Logout
                    </button>
                    </a>
                    <?php else: ?>
                        
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
</div></div>
