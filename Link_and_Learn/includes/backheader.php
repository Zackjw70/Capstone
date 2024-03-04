
<div class="row headerrow">
            <div class="col-2 text-start">
                <h2>Backend</h2>
            </div>
            <div class="col-8 text-center">
                <h1>Link up and Learn</h1>
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
                <a href="Login.php">
                <button class="custom-btn btn-14 logoutbtn" id="loginbtn">
                    Login
                </button>
                </a>
                <?php endif; ?>
            </div>
            <?php if(isset($_SESSION['user']) && $_SESSION['perm'] >= 2 ):?>
                    
                    <div class="text-end">
                        <a href="../admin/user.php" class="aButtons">Admin</a>
                    </div>
                <?php endif; ?>
            <div class="row headrow text-center" style="margin-top:80px;">
                <div class="col-md-3">
                    <a href="HomeEdit.php" class="aButtons">Edit Home</a>
                </div>
                <div class="col-md-3">
                    <a href="ReviewsEdit.php" class="aButtons">Reviews</a>
                </div>
                <div class="col-md-3">
                    <a href="MainInfo.php" class="aButtons">Main Info</a>
                </div>
                <div class="col-md-3">
                    <a href="../home.php" class="aButtons">Home</a>
                </div>
            </div>

            