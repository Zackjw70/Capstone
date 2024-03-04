<?php
    session_start();

    include __DIR__ . '/../DBModel/modelLink.php';

    $perm = $_SESSION['perm'];
    if($perm < 1){
        header('Location: ../home.php');
    }
    if (isset($_POST['delete'])){
        $id = filter_input(INPUT_POST, 'reviewid');
        reviewDelete($id);
    }



    $reviews = getAllReviews();



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
    <script src="https://cdn.tiny.cloud/1/vq1rq2p69wax28njpht11pigfyry07aksn56iwrrgnkrhe3x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    
    <link rel="stylesheet" href="../Stylesheets/style.css" type="text/css">
</head>
<body class="everyThang">
    <?php include '../includes/backheader.php';?>
        <div class="row">
            <div class="col-md-4 offset-md-4 text-center">
                <h1 class="head1 xtraSpacing">Reviews</h1>
            </div>
        </div>  
            <?php foreach ($reviews as $r): ?>
        <div class="xtraSpacing">
            <div class="row">
            <div class="col-md-6 offset-md-3 par" >
                
                    <b><?= $r['datesubmitted']; ?></b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 offset-md-2 text-center">
                <a href="ReviewsEdit.php?reviewid=<?= $r['Reviewid'];?>" class="custom-btn btn-14" style="text-decoration:none;">Update</a>

            </div>
            <div class="col-md-6 par">
                    <?= $r['review'];?>
            </div>
            <div class="col-md-1">
                <form method="post" name="deleteReview">
                    <input type="hidden" name="reviewid" value="<?=$r['Reviewid'];?>">
                    <button class="btn-14 custom-btn" name="delete">Delete</button>
                </form>
            </div>
                    
                    
            </div>
        </div>
        
        <?php endforeach ;?>
</body>
</html>