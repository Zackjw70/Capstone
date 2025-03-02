<?php
    session_start();
    if (empty($_SESSION['perm'])){
        $_SESSION['perm'] = 0;
        // if(empty($_SESSION['user'])){
        //     header("location: home.php");
        // }
    } 
    //Reviews page
    //Pulls all of the reviews from the database that are displayed from the backend
    //Also allows users to submit they're own reviews that are not displayed immeditetly 
    

    include __DIR__ . '/DBModel/modelLink.php';

    $allReviews = getShownReviews();

    $results = '';
    $text = '';



    if (isset($_POST)){
        $text = filter_input(INPUT_POST, "textHolder");
        $datetime = new DateTime();
        $datetime = $datetime->format('Y\-m\-d\ h:i:s');
        if(isset($_FILES['reviewImg'])){
            $temp_name = $_FILES['reviewImg']['tmp_name'];
            $path = getcwd() . DIRECTORY_SEPARATOR . 'contentImages';
            $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['reviewImg']['name'];

            move_uploaded_file($temp_name, $new_name);

            $imgUrl = str_replace(['C:\xampp\htdocs\Capstone\Link_and_Learn\contentImages\\'],'',$new_name);
        }else{
            $imgUrl = NULL;
        }
        if(!empty($text)){
            $exists = getOneReview($text);
            if ($exists = " "){
                addReview($text, $datetime, $imgUrl);
                $results = "Review submitted!";
            }
            else{

            }

        }
    }
    else{
        $datetime = '';
        $text = '';
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
    <script src="https://cdn.tiny.cloud/1/vq1rq2p69wax28njpht11pigfyry07aksn56iwrrgnkrhe3x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="Stylesheets/style.css" type="text/css">
    <style>
        .row{
            max-width:100%;
        }
    </style>
</head>
<body class="everyThang">
    <div>
    <?php include 'includes/header.php';?>
    <div class="row text-center">
            <?php if($_SESSION['perm'] > 0): ?>
                <a href="Backend/ViewReviews.php"><Button class="btn-14 custom-btn">To Back</Button></a>
                
            <?php endif ;?>
    </div>
        <div class="row">
                <div class="col-4">
                      
                </div>
                <div class="col-4 text-center">
                    <h2 class="head2">Reviews</h2>
                </div>
        </div>
        <?php if(empty($_SESSION['user'])): ?>
        <div class="row text-center" style="padding-top: 30px; padding-bottom:30px;">
            <div class="col-4">
                      
            </div>
            <div class="col-md-4 text-center">
                <h2>Sign in to leave review</h2>
            </div>
        </div>
        <?php else: ?>
        <div class="row text-center" style="padding-top: 30px; padding-bottom:30px;">
            <div class="col-4">
                      
            </div>
            <div class="col-md-4 text-center">
                <button class="custom-btn btn-14" style="display:inline;width: 300px;"  id="Reviewbtn">
                    Leave Review
                </button>
            </div>
        </div>
        <?php endif; ?>
        <div class="row" >
            <div class="col-2">
                      
                      </div>
                      <div class="col-8 text-center"  style="display:none" id="hiddenarea">
                          <script>
                            tinymce.init({
                                selector: 'textarea',
                                plugins: 'anchor wordcount',
                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough |',
                                tinycomments_mode: 'embedded',
                                tinycomments_author: 'Author name',
                                mergetags_list: [
                                { value: 'First.Name', title: 'First Name' },
                                { value: 'Email', title: 'Email' },
                                ],
                                
                            });
                        </script>
                        <textarea placeholder="Leave Review Here!">
                            
                        </textarea>
                        
                        
                        
                      </div>
        


        </div>
        <div class="row text-center" style="display:none" id="hiddencheck1">
            <div class="col-4" class="display: block">            
            </div>
            <form method="POST" id="ReviewMCE" name="uploadForm" enctype="multipart/form-data" >
                <input type="file" name="reviewImg">
            <div class="col-4 text-center" style="padding-top:30px;padding-bottom:30px; margin-left:auto;margin-right:auto;">
                <input type="checkbox" name="check1" id="check1"><!--Legal stuff-->
                <label for="check1">I acknowledge that the image used contains only my child </label><br>
                <input type="checkbox" name="check2" id="check2">
                <label for="check2">I allow the use of this photo and review to be posted online </label>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-lg-4 offset-lg-4 par" style="color:red" id="errors" >
            
            </div>
            
        </div>
        <div class="row text-center" style="display:none" id="hiddensub">
            <div class="col-4" class="display: block">
                    
            </div>
            <div class="col-4 text-center" style="padding-top:30px;padding-bottom:30px; margin-left:auto;margin-right:auto;">
                
                    <input type="hidden" name="textHolder" id="TinyMceTxt">
                    <button class="custom-btn btn-14">
                        Submit
                    </button>

                </form>
                
            </div>
            
        </div>
        <div class = "row text-center">
            <h3 class="head3"><?= $results;?></h3>
        </div>
        <div>

        </div>
        <div class="row text-center">
            <div class="col-4">

            </div>
            <div class="col-4">
                <h2 class="head2">All Reviews</h2>
            </div>
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
        <footer class="row footextra Layout container">
            <?php include 'includes/footer.php';?>
        </footer>

        
        
        
        
    </div>
    <div>

    </div>
    <div>

    </div>
    
    <script>//This is the TinyMCE Display and checker


        function santitize(textInput){
            var element = document.createElement('div');
            element.innerText = textInput;
            let sanitized = element.innerHTML;
            sanitized = sanitized.replace(/<\/?p>/g, '');

            return sanitized;
        }

        var booten = document.querySelector(`#Reviewbtn`).addEventListener(`click`,(e) =>{
            var hidden = document.querySelector(`#hiddensub`).style.display = "block"
            var hiddenarea = document.querySelector(`#hiddenarea`).style.display = "inline"
            var check1 = document.querySelector(`#hiddencheck1`).style.display ="inline"
            var boot = document.querySelector(`#Reviewbtn`).style.display = "none"
            
            
            
        })
        var subbtn = document.querySelector(`#hiddensub`).addEventListener(`click`, (e) =>{
                e.preventDefault()
                var error = document.querySelector(`#errors`)
                let checkb1 = document.querySelector(`#check1`)
                let checkb2 = document.querySelector(`#check2`)
                if (checkb1.checked == true && checkb2.checked == true){
                    var text = tinymce.activeEditor.getContent()
                    if (text != "<p></p>" && text != ""){
                        console.log(text)
                        text = santitize(text);
                        inpi = document.querySelector(`#TinyMceTxt`)
                        inpi.value = text
                        form = document.querySelector(`#ReviewMCE`)
                        console.log(form)
                        form.submit()
                        
                        
                        

                        

                        
                        
                    }
                    else{
                        error.innerHTML = "Can not leave review blank!"
                    }
                    
                }
                else{
                error.innerHTML = "Must agree to our review terms!"

                }
                
                
            })
        
    
    
    </script>
    
</body>
</html>