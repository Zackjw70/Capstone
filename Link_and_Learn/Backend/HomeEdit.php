<?php
    session_start();

    include __DIR__ . '/../DBModel/modelLink.php';

    $perm = $_SESSION['perm'];
    if($perm < 1){
        header('Location: ../home.php');
    }

    if (isset($_POST['delete'])){
        $id = filter_input(INPUT_POST, 'textid');
        contentDelete($id);
    }


    if(isset($_POST['newAnnoHidden'])){
        $newAnno = filter_input(INPUT_POST, "newAnnoHidden");
        $now = new DateTime();
        $now = $now->format('Y\-m\-d\ h:i:s');
        if(!empty($newAnno)){
            $exists = getOneContent($newAnno);
            if ($exists = ' '){
                addContent($newAnno, 1, $now, $now);
            }
        }

        
    }
    if(isset($_POST['newAboutHidden'])){
        $newAbout = filter_input(INPUT_POST, "newAboutHidden");
        $now = new DateTime();
        $now = $now->format('Y\-m\-d\ h:i:s');
        if(!empty($newAbout)){
            $exists = getOneContent($newAbout);
            if ($exists = ' '){
                addContent($newAbout, 2, $now, $now);
            }
        }
    }
    if(isset($_POST['uploadImg'])){
        if(isset($_FILES['mainImg'])){
            $temp_name = $_FILES['mainImg']['tmp_name'];

            $path = getcwd() . DIRECTORY_SEPARATOR . '../images';
            $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['mainImg']['name'];

            move_uploaded_file($temp_name, $new_name);

            $imgUrl = str_replace(['C:\xampp\htdocs\Capstone\Link_and_Learn\Backend\../'],'',$new_name);
            $now = new DateTime();
            $now = $now->format('Y-m-d');
            deleteImages();
            addContent($imgUrl, 3, $now, $now);
            

            
        }
    }
    if(isset($_POST['uploadBaseImg'])){
        if(isset($_FILES['imgBase'])){
            $temp_name = $_FILES['imgBase']['tmp_name'];

            $path = getcwd() . DIRECTORY_SEPARATOR . '../contentImages';
            $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['imgBase']['name'];

            move_uploaded_file($temp_name, $new_name);

            $imgUrl = str_replace(['C:\xampp\htdocs\Capstone\Link_and_Learn\Backend\../contentImages\\'],'',$new_name);
            $now = new DateTime();
            $now = $now->format('Y-m-d');
            $exists = getOneContent($imgUrl);
            if (empty($exists)){
                addContent($imgUrl, 4, $now, $now);
            }
            
        }
    }
    if(isset($_POST['delBaseImg'])){
        $id = filter_input(INPUT_POST, 'baseImg');
        contentDelete($id);
    }
    $anno = getContent(1);
    $desc = getContent(2);
    $img = getOneImage(3);
    $footImg = getFootImages(4);
    


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
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
            ],
            
        });
    </script>
    <style>
        .row{
            width:100%;
        }
    </style>
</head>
<body class="everyThang">
    <div>
        <?php include '../includes/backheader.php';?>
    </div>
    
        <div>
            <div class="row text-center">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h2 class="head2">Home</h2>
                </div>
                
                
            </div>
            <div class="row xtraSpacing text-center">
                <div class="col-md-4 offset-md-4">
                    <a href="../home.php"><Button class="custom-btn btn-14">View Front</Button></a>
                </div>
            </div>
            <div class="row xtraSpacing text-center">
                <div class="col-md-4 offset-md-4"><h3 class="head3">Main Image</h3></div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 offset-md-4">
                <img src="../<?= $img['contentText']; ?>" style="height:150px; width:150px;">
                    <form method="post" id="imageUpload" name="imageUpload"  enctype="multipart/form-data">
                        <input type="file" name="mainImg" value="../<?= $img['contentText']; ?>">
                        <input type="submit" class="xtraSpacing" value="Upload" name="uploadImg">
                    </form>
                </div>
            </div>
            <div class="row text-center">
            <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h2 class="head2">Announcments</h2>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <button class="btn-14 custom-btn" id="annoAddNewButton">Add New</button>
                </div>
                
            </div>
            
                <div class="row text-center" style="margin-top:50px;margin-bottom:50px;">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center hiddenitems">
                    <textarea id="annoTextArea" name="annoTextArea" placeholder="Leave Announcement Here!">
                        
                    </textarea>
                    <form method="post" id="annoSubmitNew">
                    <input type="hidden" id="newAnnoHidden" name="newAnnoHidden">
                    <button class="custom-btn btn-14" id="annoSubmitBtn" style="display:none;" nane="annoNewSub">
                        Submit
                    </button>
                </div>
            </form>
            
                
            </div>
            <?php foreach ($anno as $a):?>
            <div class="row text-left xtraSpacing">
            
                <form method="POST" style="display:flex;">
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-1">
                    <a href="editContent.php?infoid=<?= $a['infoid'];?>" class="custom-btn btn-14" style="text-decoration:none;">Update</a>
                    </div>
                    <div class="col-md-5 par listBorder">
                        
                        <input type="hidden" name="textid" value="<?=$a['infoid'];?>">
                        <p><?= $a['contentText'];?></p>
                        
                        
                        
                    </div>
                    <div class="col-md-1 listBorder">
                        <p class="par"><?=date('Y-m-d', strtotime($a['uploadDate'])); ?></p>
                    </div>
                    <div class="col-md-1">
                        <input type="hidden" name="textid" value="<?=$a['infoid'];?>">
                        <button class="btn-14 custom-btn" name="delete">Delete</button>
                        
                    </div>
                </form>
                
                
                
            </div>
            <?php endforeach;?>
            <div class="row text-center">
            <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h2 class="head2">About</h2>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 offset-md-4">
                    <button class="btn-14 custom-btn" id="descAddNewButton">Add New</button>
                </div>
            </div>
            <div class="row text-center" style="margin-top:50px;margin-bottom:50px;">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center hiddenitems2">
                    <textarea id="aboutTextArea" name="aboutTextArea" placeholder="Leave About Terri Content Here!">
                        
                    </textarea>
                    <form method="post" id="aboutSubmitNew">
                    <input type="hidden" id="newAboutHidden" name="newAboutHidden">
                    <button class="custom-btn btn-14" id="aboutSubmitBtn" style="display:none;" nane="aboutNewSub">
                        Submit
                    </button>
                </div>
            </form>
            
                
            </div>
            <?php foreach ($desc as $d) :?>
            <div class="row text-left xtraSpacing">
                <form method="POST" style="display:flex;">
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-1">
                        <a href="editContent.php?infoid= <?=$d['infoid'];?>" class="custom-btn btn-14" style="text-decoration:none;">Update</a>
                    </div>
                    <div class="col-md-5 par">
                        <input type="hidden" name="textid" value="<?=$d['infoid'];?>">
                        <p><?=$d['contentText'];?></p>
                    </div>
                    <div class="col-md-1">
                        <p class="par"><?=date('Y-m-d', strtotime($d['uploadDate'])); ?></p>
                    </div>
                    <div class="col-md-1">
                        <input type="hidden" name="textid" value="<?=$d['infoid'];?>">
                        <button class="btn-14 custom-btn" name="delete">Delete</button>
                        
                    </div>
                </form>
                </div>
            <?php endforeach;?>
            
            
        </div>
        <div class="row ">
            <div class="col-md-8 offset-md-2">
                <form method="post" id="imageBottom" name="imgBottomUpload"  enctype="multipart/form-data">
                    <div>
                    <input type="file" name="imgBase">
                    <br>
                    <input type="submit" class="xtraSpacing" value="Upload" name="uploadBaseImg" style="float-bottom">
                    </div>

                        
                </form>
            </div>
        </div>
        <div class="row " style="margin-bottom:50px;"style="display:inline">
            <div class="col-md-8 offset-md-2">
                    <?php foreach($footImg as $f):?>
            
                    <img src="../contentImages/<?= $f['contentText']; ?>" style="height:150px;">
                    <form method="post">
                        <input type="hidden" value="<?= $f['infoid']; ?>" name="baseImg">
                        <button class="custom-btn btn-14 text-center" style="float:bottom; left:8px;" name="delBaseImg">Delete</button>
                    </form>
                    
                    <?php endforeach;?>
                
            </div>
        </div>
               
        <script>
            var annoNew = document.querySelector(`#annoAddNewButton`).addEventListener(`click`,(e) =>{
                var annoMCE = document.querySelector(`.hiddenitems`).style.display = "inline"
                var annoSubmitNew = document.querySelector(`#annoSubmitBtn`).style.display = "inline"
                var annoNewButton = document.querySelector(`#annoAddNewButton`).style.display = "none"
            
            
            
        })
            var annoSubmitNew = document.querySelector(`#annoSubmitBtn`).addEventListener(`click`, (e) =>{
                e.preventDefault()
                annoform = document.querySelector(`#annoSubmitNew`)
                var annoContent = tinymce.activeEditor.getContent('#annoTextArea')
                newAnnoHidden = document.querySelector(`#newAnnoHidden`).value = annoContent
                console.log(annoform)
                annoform.submit('annoSubmitNew')

            })
            var aboutNew = document.querySelector(`#descAddNewButton`).addEventListener(`click`,(e) =>{
                var aboutMCE = document.querySelector(`.hiddenitems2`).style.display = "inline"
                var aboutSubmitNew = document.querySelector(`#aboutSubmitBtn`).style.display = "inline"
                var aboutNewButton = document.querySelector(`#descAddNewButton`).style.display = "none"
            
            })
            var aboutSubmitNew = document.querySelector(`#aboutSubmitBtn`).addEventListener(`click`, (e) =>{
                e.preventDefault()
                aboutform = document.querySelector(`#aboutSubmitNew`)
                var aboutContent = tinymce.activeEditor.getContent('#aboutTextArea')
                newAboutHidden = document.querySelector(`#newAboutHidden`).value = aboutContent
                console.log(aboutform)
                aboutform.submit('aboutSubmitNew')

            })
        </script>
</body>
</html>