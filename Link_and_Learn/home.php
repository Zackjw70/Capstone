<?php
    session_start();

    include __DIR__ . '/DBModel/modelLink.php';

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
        body{
            background-color:#EAD064;
        }
        h1{
            font-family: "Architects Daughter", cursive;
            font-weight: 400;
            font-style: normal;
            height: 50px;
            color:#B93836;
            font-size:60px;
            margin-left:auto;margin-right:auto;
            margin-top:50px;
            
        }
        .footextra{
            background-color:#EABC64;
            position: relative;
            bottom: 0;
            width: 100.5%;
            padding-top:10px;
            font-size: 20px;
            font-family: "Inter", sans-serif;
            font-weight: 400;

        }
        .loginbtn{
            margin-top:80px;
            width: 200px;
            height: 60px;
            font-size:26px;
            margin-right: 50%;

        }
        .logoutbtn{
            width: 200px;
            height: 60px;
            font-size:26px;
        }
        .username{
            margin-top:20px;
            max-height: 30px;
            font-size:26px;
            margin-right: 50%;
            width:100%;
            overflow: hidden;
            
        }
        .headerrow{
            background-color:#EABC64;
            width:100.5%;
            overflow: hidden;
        }
        .logobtn{
            opacity: 50%;
        }
        @media only screen and (max-width: 1000px) {
            h1{
                margin-left: 200px;
                font-size:45px;   
            }
            .logbtns{
                display:block;
                width: 100%;
                height: 150px;
            }
            .username{
                display:block;
                margin-bottom:30px;
                width: 100%;
            }
            .bookbtn{
            }
        }
        h2, h3{
            font-family: "Architects Daughter", cursive;
            font-weight: 400;
            font-style: normal;
            color:#B93836;
            font-size:50px;
            margin-top:50px;
        }
        h3{
            font-size: 30px;
        }
        .row{
            max-width: 100.5%;
        }
        textarea{
            padding-top:30px;
            padding-bottom:30px;
        }
        .hiddenitems{
            display: none;
        }
        p{
            line-height: 1.5;
            font-family: "Lato";
            font-size: 20px;
        }
        .anno{
            font-size: 35px;
        }

    </style>
    
</head>
<body>
    <div>
        <?php include 'includes/header.php';?>
        <div>

        </div>
        <div class="row text-center" style="margin-bottom:20px;">
            <div class="col-4"></div>
            <div class="col-md-4"><h2>Announcments</h2></div>
            <div class="col-md-1"></div>
            <div class="col-md-3"><a href=""><button class="custom-btn btn-14 bookbtn" style="width:300px; margin-top:20px;margin-bottom:20px;">Book an appointment</button></a></div>
            
        </div>
        <?php foreach ($anno as $a): ?>
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-6" style=" border-bottom: 1px solid black;">
                    <b><?=$a['contentText']; ?></b>  
                </div>
                <div class="col-1" style=" border-bottom: 1px solid black;">
                    <?=date("m/d/Y", strtotime($a['lastedited'])); ?>
                </div>
            </div>
        <?php endforeach;?>
        <div class="row text-center">
            
        </div>
        <div class="row text-center">
            <h2>About Terri Clayman</h2>
        </div>
        <?php foreach ($desc as $d): ?>
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-6">
                    <?=$d['contentText']; ?>
                </div>
            </div>
        <?php endforeach;?>
        
        <div class="row text-center">
            <h2>Reviews</h2>
        </div>
        <?php foreach ($allReviews as $a): ?>
            <div class="row" style="margin-top:40px; margin-bottom:40px;">
                <div class="col-3">

                </div>
                <div class="col-6" style=" border-bottom: 1px solid black;">
                    <?= $a['review'];?>
                </div>
                <div class="col-1" style=" border-bottom: 1px solid black;">
                    <?= date("Y-m-d", strtotime($a['datesubmitted'])); ?>
                </div>
            </div>
            
        <?php endforeach; ?>
        <div class="row text-center">
        <a href="Reviews.php" style="margin-bottom:40px;margin-top:40px;"><button class="custom-btn btn-14" style="width:300px;">More Reviews</button></a>
        </div>
        <div class="row">

        </div>
        <div class="row text-center">
        <a href="home.php"><button class="custom-btn btn-14" style="width:300px; margin-bottom:80px;">Return to Top</button></a>
        </div>


        <footer class="row footextra">
            <p>Name:</p>
            <p>Phone:</p>
            <p>Email:</p>
        </footer>

        
        
        
        
    </div>
    <div>

    </div>
    <div>

    </div>
    
    
</body>
</html>