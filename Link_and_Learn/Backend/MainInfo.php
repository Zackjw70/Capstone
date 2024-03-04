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
    <link rel="stylesheet" href="../Stylesheets/style.css" type="text/css">
    <script src="https://cdn.tiny.cloud/1/vq1rq2p69wax28njpht11pigfyry07aksn56iwrrgnkrhe3x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
                margin-top:50px;
                display:block;
                width: 100%;
                height: 150px;
            }
            .username{
                display:block;
                margin-bottom:30px;
                width: 100%;
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
        .aButtons{
            text-decoration:none;
            color:#B93836;
            font-family: "Architects Daughter", cursive;
            font-weight: 400;
            font-style: normal;
            font-size:30px;
        }
        .aButtons:hover{
            color:black;
        }

    </style>
</head>
<?php

    $info = getmain();
    $title = $info["title"];
    $picture = $info["picture"];
    $ownername = $info["ownername"];
    $phone = $info["phone"];
    $email = $info["email"];
    $error = "";

    if(isset($_POST['uploadImg'])){
        if(isset($_FILES['mainImg'])){
            var_dump($temp_name = $_FILES['mainImg']['tmp_name']);
            $temp_name = $_FILES['mainImg']['tmp_name'];

            $path = getcwd() . DIRECTORY_SEPARATOR . '../images';
            $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['mainImg']['name'];

            move_uploaded_file($temp_name, $new_name);

            $imgUrl = str_replace(['C:\xampp\htdocs\Capstone\Link_and_Learn\Backend../'],'',$new_name);
            $now = new DateTime();
            $now = $now->format('Y-m-d');
            deleteImages();
            addContent($imgUrl, 3, $now, $now);

        }
    }

    if(isset($_POST['submit_changes'])){
        $title = filter_input(INPUT_POST, 'titlename');
        $picture = filter_input(INPUT_POST, 'mainImg');
        $ownername = filter_input(INPUT_POST, 'ownername');
        $phone = filter_input(INPUT_POST, 'phonenumber');
        $email = filter_input(INPUT_POST, 'emailurl');

        if($error == ""){
            editmain($title, $picture, $ownername, $phone, $email);
            header('Location: homeedit.php');
        }
    }
    

?>
<body>
    <?php include '../includes/backheader.php';?>
    </div>
    
    <form name="account" method="post">
        <div>
            <form method="post" name="maininfo">
                <div class="spacing">
                <label>Page Name: </label>
                <input type="text" name="titlename" value="Link up and Learn">
                </div>
                <br>
                <div class="spacing">
                <label>Logo: </label>
                <img src="../images/Link_up_and_learn_logo;" style="height:150px; width:150px;">
                    <form method="post" id="imageUpload" name="imageUpload"  enctype="multipart/form-data">
                        <input type="file" name="mainImg" value="../<?= $img['contentText']; ?>">
                        <input type="submit" class="xtraSpacing" value="Upload" name="uploadImg">
                    </form>
                </div>
                <!--<img src="../images/Link-up_and_Learn_Logo.png" width="200" height="200">-->
                <!--<input type="button" name="imagebutton" value="change image">-->
                </div>
                <br>
                <div class="spacing">
                <label>Name: </label>
                <input type="text" name="ownername" value="Terri Clayman">
                </div>
                <br>
                <div class="spacing">
                <label>Phone: </label>
                <input type="text" name="phonenumber" value="111-222-3333">
                </div>
                <br>
                <div class="spacing">
                <label>Email: </label>
                <input type="text" name="emailurl" value="TerriClayman@gmail.com">
                </div>
                <div>
                    &nbsp;
                </div>
                <div>
                <input type="submit" name="submit_changes" value="Submit Changes" style="width: 150px">
                </div>

            </form>
        </div> 
    </form>


    
</body>
