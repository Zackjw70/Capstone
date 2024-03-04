
<div class="row headerrow">
            <div class="col-2 text-start">
                <h2 class="head2">Backend</h2>
            </div>
            <div class="col-8 text-center">
                <h1 class="head1">Link up and Learn</h1>
            </div>
            <div class="col-2 text-center logbtns">
                <?php if(isset($_SESSION['user'])): ?>
                    <h3 class="username head3"><?= $_SESSION['user']; ?></h3>
                    <a href="../Logout.php">
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
            <div class="row headrow" style="margin-top:80px;">
                <div class="col-md-4">
                    <a href="HomeEdit.php" class="linkButtons">Home</a>
                </div>
                <div class="col-md-4">
                    <a href="ViewReviews.php" class="linkButtons">Reviews</a>
                </div>
                <div class="col-md-4">
                    <a href="MainInfo.php" class="linkButtons">Main Info</a>
                </div>
            </div>
                </div>
            