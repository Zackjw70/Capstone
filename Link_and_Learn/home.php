<?php
    session_start();

    include __DIR__ . '/DBModel/modelLink.php';
    $count = 0;
    $allReviews = getShown3();
    
    
    if (!empty($desc = getContent(2))){

    }
    else{
        $desc = [];
    }
    if (!empty($anno = getContent(1))){

    }
    else{
        $anno = [];
    }
    $img = getOneImage(3);
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link-Up and Learn</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Stylesheets/style.css" type="text/css">
</head>
<body class="everyThang">
    <div>
        <?php include 'includes/header.php';?>
        <div class="row text-center xtraSpacing">
            <?php if(($_SESSION['perm'] != NULL) && ($_SESSION['perm'] > 0)): ?>
                <a href="Backend/HomeEdit.php"><Button class="btn-14 custom-btn">To Back</Button></a>
                
            <?php endif ;?>
        </div>
        
        <div class="row text-center" style="margin-bottom:20px;">
            <div class="col-4"></div>
            <div class="col-md-4"><h2 class="head2">Announcments</h2></div>
            <div class="col-md-1"></div>
            <div class="col-md-3"><a href="https://calendly.com/andrewrockwell20/test" target="_blank"><button class="custom-btn btn-14 bookbtn" style="width:300px; margin-top:20px;margin-bottom:20px;">Book an appointment</button></a></div>
            
        </div>
        
        <?php foreach ($anno as $a): ?>
            <div class="row">
                <div class="col-3">

                </div>
                
                    
                
                <div class="col-6 listBorder">
                

                    
                
                
                    <b class="par"><?=$a['contentText']; ?></b>  
                </div>
                <div class="col-1 listBorder">
                    <?=date("m/d/Y", strtotime($a['lastedited'])); ?>
                </div>
            </div>
        <?php endforeach;?>
        <div class="row text-center">
            
        </div>
        <div class="row text-center">
            <h2 class="head2">About Terri Clayman</h2>
        </div>
        <?php foreach ($desc as $d): ?>
            <div class="row">
                <div class="col-3">

                </div>
                
                <div class="col-6 hiddenExtra par">
                    <?php if ($count == 0){
                    echo '<img src="', $img['contentText'], '" class="baseImg">';
                    $count++;
                }?>
                    <?=$d['contentText']; ?>
                </div>
            </div>
        <?php endforeach;?>
        
        <div class="row text-center">
            <h2 class="head2">Reviews</h2>
        </div>
        <?php foreach ($allReviews as $a): ?>
            <div class="row xtraSpacing">
                <div class="col-3">

                </div>
                <div class="col-6 listBorder par">
                    <?= $a['review'];?>
                </div>
                <div class="col-1 listBorder">
                    <?= date("Y-m-d", strtotime($a['datesubmitted'])); ?>
                </div>
            </div>
            
        <?php endforeach; ?>
        <div class="row text-center">
        <a href="Reviews.php" class="xtraSpacing"><button class="custom-btn btn-14 wideButton">More Reviews</button></a>
        </div>
        <div class="row">

        </div>
        <div class="row text-center">
        <a href="home.php"><button class="custom-btn btn-14 wideButton" style="margin-bottom:80px;">Return to Top</button></a>
        </div>


        <footer class="row footextra">
        <?php include 'includes/footer.php';?>
        </footer>

        
        
        
        
    </div>
    <div>

    </div>
    <div>

    </div>
    
    
</body>
</html>