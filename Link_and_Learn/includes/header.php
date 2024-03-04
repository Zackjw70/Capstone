<div class="row headerrow">
            <div class="col-2 text-start">
                <a href="home.php">
                    <img src="images/Link-up_and_Learn_Logo.png" alt="Home" class="logobtn" style="height:150px; width:150px;">
                </a>
            </div>
            <div class="col-8 text-center">
                <h1 class="head1">Link up and Learn</h1>
            </div>
            <div class="col-2 text-center logbtns">
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
        </div>