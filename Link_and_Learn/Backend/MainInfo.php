<?php
    session_start();

    include __DIR__ . '/../DBModel/modelLink.php';

    $perm = $_SESSION['perm'];
    if($perm < 1){
        header('Location: ../home.php');
    }



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Info</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.tiny.cloud/1/vq1rq2p69wax28njpht11pigfyry07aksn56iwrrgnkrhe3x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="../Stylesheets/style.css" type="text/css">
    <style>
        .row{
            width:100%;
        }
    </style>
</head>
<?php
$error = "";

    
    

    /*if(isset($_POST['uploadImg'])){
        if(isset($_FILES['mainImg'])){
            var_dump($temp_name = $_FILES['mainImg']['tmp_name']);
            $temp_name = $_FILES['mainImg']['tmp_name'];

            $path = getcwd() . DIRECTORY_SEPARATOR . '../images';
            $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['mainImg']['name'];

            move_uploaded_file($temp_name, $new_name);

            $imgUrl = str_replace(['C:\xampp\htdocs\Capstone\Link_and_Learn\Backend../'],'',$new_name);
            $now = new DateTime();
            $now = $now->format('Y-m-d');
            $picture = $imgUrl;
            editmain($title, $picture, $ownername, $phone, $email);

        }
    }*/
    $info = getmain();

    if(isset($_POST['submit_changes'])){
        $title = filter_input(INPUT_POST, 'titlename');
        if(isset($_FILES['mainImg'])){
            $temp_name = $_FILES['mainImg']['tmp_name'];

            $path = getcwd() . DIRECTORY_SEPARATOR . '../images';
            $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['mainImg']['name'];

            move_uploaded_file($temp_name, $new_name);

            

            $imgUrl = str_replace(['C:\xampp\htdocs\Capstone\Capstone\Link_and_Learn\Backend\../'],'',$new_name);
            $picture = $imgUrl;
            if ($picture = "images\\"){
                $picture = $info["picture"];
            }

            
        }

        $ownername = filter_input(INPUT_POST, 'ownername');
        $phone = filter_input(INPUT_POST, 'phonenumber');
        $email = filter_input(INPUT_POST, 'emailurl');

        if($error == ""){
            editmain($title, $picture, $ownername, $phone, $email);
            header('Location: homeedit.php');
        }
    }
    
    $title = $info["title"];
    $picture = $info["picture"];
    $ownername = $info["ownername"];
    $phone = $info["phone"];
    $email = $info["email"];
    
    

?>
<body class="everyThang">
    <?php include '../includes/backheader.php';?>
</div>
    <div class="row text-center justify-content-center">
    <form name="account" method="post">
        <div>
            <form method="post" name="logo">
            <div class="spacing">
            
                <img src="../<?= $info['picture']; ?>" style="height:150px; width:150px;">
                    <form method="post" id="imageUpload" name="imageUpload"  enctype="multipart/form-data">
                        
                    
        </div>
            </form>
            <form method="post" name="maininfo"   enctype="multipart/form-data">
                <div class="spacing">
                <label>Logo: </label>
                <input type="hidden" value="<?= $picture;?>">
                <input type="file" name="mainImg">
                </div>
                <br>
                <div class="spacing">
                <label>Page Name: </label>
                <input type="text" name="titlename" value='<?=$title?>' required>
                </div>
                <br>
                <!--<div class="spacing">
                <label>Logo: </label>
                <img src="../<?php //$picture;?>" style="height:150px; width:150px;">
                    <form method="post" id="imageUpload" name="imageUpload"  enctype="multipart/form-data">
                        <input type="hidden" value="<?php //$picture;?>">
                        <input type="file" name="mainImg" value="../<?php //echo $img['contentText']; ?>">
                        <input type="submit" class="xtraSpacing" value="Upload" name="uploadImg">
                    </form>
                </div>-->
                <!--<img src="../images/Link-up_and_Learn_Logo.png" width="200" height="200">-->
                <!--<input type="button" name="imagebutton" value="change image">-->
                <!--</div>-->
                <br>
                <div class="spacing">
                <label>Name: </label>
                <input type="text" name="ownername" value='<?=$ownername?>' required>
                </div>
                <br>
                <div class="spacing">
                <label>Phone: </label>
                <input type="tel" name="phonenumber" value='<?=$phone?>' required>
                </div>
                <br>
                <div class="spacing">
                <label>Email: </label>
                <input type="email" name="emailurl" value='<?=$email?>' required>
                </div>
                <div>
                    &nbsp;
                </div>
                <div>
                <input type="submit" name="submit_changes" value="Submit Changes" style="width: 150px">
                </div>

            </form>
        </div>
        </div> 
    </form>
    </div>


    
</body>
