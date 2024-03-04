<?php
    session_start();

    include __DIR__ . '/../DBModel/modelLink.php';

    $perm = $_SESSION['perm'];
    if($perm < 1){
        header('Location: ../home.php');
    }

    $anno = getContent(1);

    if (isset($_POST['delete'])){
        $id = filter_input(INPUT_POST, 'textid');
        contentDelete($id);
        header("Refresh:0");
    }


    if(isset($_POST['newAnnoHidden'])){
        $newAnno = filter_input(INPUT_POST, "newAnnoHidden");
        $now = new DateTime();
        $now = $now->format('Y\-m\-d\ h:i:s');
        if(!empty($newAnno)){
            $exists = getOneContent($newAnno);
            if ($exists = ' '){
                addContent($newAnno, 1, $now);
                header("Refresh:0");
            }
        }

        
    }else{

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
        .deleteContentbtn{
            text-decoration:none;
            color:#B93836;
            font-family: "Architects Daughter", cursive;
            font-weight: 400;
            font-style: normal;
            font-size:30px;
        }
        .deleteContentbtn:hover{
            color:black;
        }

    </style>
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
</head>
<body>
    <div>
        <?php include '../includes/backheader.php';?>
    </div>
    
        <div>
            <div class="row text-center">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h2>Home</h2>
                </div>
                
                
            </div>
            <div class="row text-center">
            <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h2>Announcments</h2>
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
            <div class="row text-center">
            <?php foreach ($anno as $a):?>
                <form method="POST" style="display:flex;">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-5" style="border-bottom: 2px solid black; margin-bottom:60px;">
                        
                        <input type="hidden" name="textid" value="<?=$a['infoid'];?>">
                        <p><?= $a['contentText'];?></p>
                        
                        
                        
                    </div>
                    <div class="col-md-1">
                        <p><?=date('Y-m-d', strtotime($a['lastedited'])); ?></p>
                    </div>
                    <div class="col-md-1">
                        <form method="post">
                            <input type="hidden" name="textid" value="<?=$a['infoid'];?>">
                            <button class="btn-14 custom-btn" name="update">Update</button>
                        </form>
                        
                        <button class="btn-14 custom-btn" name="delete">Delete</button>
                        
                    </div>
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
        </script>
</body>
</html>