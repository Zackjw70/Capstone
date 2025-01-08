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
    $info = getmain();

    if(isset($_POST['submit_changes'])){
        $title = filter_input(INPUT_POST, 'titlename');
        if(isset($_FILES['mainImg'])){
            $temp_name = $_FILES['mainImg']['tmp_name'];

            $path = getcwd() . DIRECTORY_SEPARATOR . '../images';
            $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['mainImg']['name'];

            move_uploaded_file($temp_name, $new_name);

            

            $imgUrl = str_replace(['C:\xampp\htdocs\Capstone\Link_and_Learn\Backend\../'],'',$new_name);
            $picture = $imgUrl;
            if ($picture == "images\\"){
                $picture = $info["picture"];
            }

            
        }

        $ownername = filter_input(INPUT_POST, 'ownername');
        $phone = filter_input(INPUT_POST, 'phonenumber');
        if(!preg_match('/[0-9]{3}-[0-9]{3}-[0-9]{4}/', $phone)) {
            $error .= "<li>Invalid phone number format ex: 111-222-3333</li>";
        }
        $email = filter_input(INPUT_POST, 'emailurl');
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "<li>Invalid email format ex: test@gmail.com</li>";
        }

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
    <div class="col-md-5 offset-md-5 form" style="margin-top: 15px;">
    <form name="account" method="post">
        <div>
            <form method="post" name="logo">
            <div class="offset-md-2" >
            
                <img src="../<?= $info['picture']; ?>" style="height:150px; width:150px;">
                    <form method="post" id="imageUpload" name="imageUpload"  enctype="multipart/form-data">
            </div>
                        
                    
        </div>
            </form>
            <form method="post" name="maininfo"   enctype="multipart/form-data">
                <table class="text-center">
                    <tr>
                        <td>
                            <label>Logo: </label>
                        </td>
                        <td>
                        <input type="hidden" value="<?= $picture;?>">
                        <input type="file" name="mainImg" class="inputsep2">
                        <td>
                    </tr>
                
                    <tr>
                        <td>
                            <label class="inputsep2 par">Title: </label>
                        </td>
                        <td>
                            <input type="text" name="titlename" value='<?=$title?>' class="inputLog inputsep2" required>
                        </td>
                    </tr>
                
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
                
                    <tr>
                        <td>
                            <label class="inputsep2 par">Name: </label>
                        </td>
                        <td>
                            <input type="text" name="ownername" value='<?=$ownername?>' class="inputLog inputsep2" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="inputsep2 par">Phone: </label>
                        </td>
                        <td>
                        <input type="text" name="phonenumber" value='<?=$phone?>' class="inputLog inputsep2" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="inputsep2 par">Email: </label>
                        </td>
                        <td>
                            <input type="text" name="emailurl" value='<?=$email?>' class="inputLog inputsep2" required>
                        </td>
                    
                    
                    </tr>
                </table>
                <div>
                    &nbsp;
                </div>
                <div style="color:red;height:20px;margin-bottom:15px;">
                    <ul>
                    <?=$error?>
                    </ul>
                </div>
                <div class="offset-md-2">
                <input type="submit" name="submit_changes" value="Submit Changes" style="width: 150px">
                </div>

            </form>
        </div>
        </div> 
    </form>
    </div>


    
</body>
