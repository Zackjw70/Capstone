<div class="row headerrow2 m-0">
        <div class="col-sm-2 text-start">
            <h2 class="head1">Admin</h2>
        </div>
        <div class="col-lg-6 col-md-6 text-left">
            <h1 class="head1">Link up and Learn</h1>
        </div>
        <div class="col-lg-1" style="margin-top:20px;">
            <a href="../Backend/HomeEdit.php" class="linkButtons">Back</a>
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
                    <a href="../Logout.php">
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
            <div class="row text-center" style="margin-top:30px;">
                <div class="col-md-4 col-sm-1">
                    <a href="User.php" class="linkButtons">User</a>
                </div>
                <div class="col-md-4 col-sm-1">
                    <a href="ChangeLog.php" class="linkButtons">Change Log</a>
                </div>
                <div class="col-md-4 col-sm-1">
                    <a href="LoginAttempts.php" class="linkButtons">Login Attempt</a>
                </div>
            </div>
        
</div>