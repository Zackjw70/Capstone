<?php
    session_start();
    if (empty($_SESSION['perm'])){
        $_SESSION['perm'] = 0;
    } 

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
    $baseImg = getFootImages(4);
    

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
    <style>
          .row{
            max-width: 100%;
        }
    </style>
</head>
<body class="everyThang">
    <div>
        <?php include 'includes/header.php';?>
        <div class="row m-0 booking">
            <div class="col-md-4">
                <p class="needHelp">
                    Need Help?
                </p>
            </div>
            <div class="col-lg-2 col-md-1 toBack">
                <?php if(($_SESSION['perm'] != NULL) && ($_SESSION['perm'] > 0)): ?>
                    <a href="Backend/HomeEdit.php"><Button class="btn-14 custom-btn">To Back</Button></a>
                    
                <?php endif ;?>
            </div>
            <div class="col-md-6">
                <p class="bookHere">
                    <a href="https://calendly.com/andrewrockwell20/test"  target="_blank">Book an Appointment</a>
                </p>
            </div>
            <div class="col-lg-1">

            </div>
            
            

            
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-0">
                <img src="images/Crayons.png" class="crayonImg">
            </div>
            <div class="col-lg-8" class="annoExtra">
                <h2 class="head2">Announcments</h2>
                <?php foreach ($anno as $a): ?>
                    <div class="row" style="margin-top:20px;font-size:20px;">
                        <b><?=date("m/d/Y", strtotime($a['lastedited'])); ?></b>
                    </div>
                    <div class="row" style="margin-top:0px;font-size:25px;padding-top:0px;">
                        <p class="par"><?=$a['contentText']; ?></p>  
                    </div>
                            

                <?php endforeach;?>

            </div>
            
        </div>
        <div class="row abouthead par aboutText m-0" style="background-color:white;width:100%;">
            <img src="<?=$img['contentText'];?>" class="baseImg">
            <h2 class="head2">About Terri Clayman</h2>
            <?php foreach ($desc as $d): ?>
                <p class="par xtraBottom"><?=$d['contentText']; ?></p>
            <?php endforeach;?>
        </div>
        
        <div class="row text-center">
            <h2 class="head2">Reviews</h2>
        </div>
        <div class="row m-0">
            <?php foreach ($allReviews as $a): ?>
                <div class="col-lg-6 offset-lg-2 par">
                    <div class="row">
                        <b><?= date("Y-m-d", strtotime($a['datesubmitted'])); ?></b>
                    </div>
                    <div class="row par xtraBottom">
                        <?= $a['review'];?>
                        
                    </div>
                    
                </div>
                <div class="col-lg-2">
                    <?php if($a['imageUrl'] !=NULL): ?>
                      <img src="contentImages/<?= $a['imageUrl'] ;?>" style="height:150px;">
                    <?php endif;?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row text-center">
        <a href="Reviews.php" class="xtraSpacing"><button class="custom-btn btn-14 wideButton">More Reviews</button></a>
        </div>
        <div class="row " style="margin-bottom:50px;">
            <div class="col-md-8 offset-md-2">
                
                <?php foreach($baseImg as $f):?>
            
                    <img src="contentImages/<?= $f['contentText']; ?>" style="height:150px;">
                    
                    <?php endforeach;?>
            </div>
        </div>
        <div class="row text-center">
        <a href="home.php"><button class="custom-btn btn-14 wideButton" style="margin-bottom:80px;">Return to Top</button></a>
        </div>


        <footer class="row footextra m-0">
        <?php include 'includes/footer.php';?>
        </footer>

        
        
        
        
    </div>
    <div>

    </div>
    <div>

    </div>
    
    
</body>
</html>