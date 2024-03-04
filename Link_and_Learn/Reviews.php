<?php
    session_start();

    include __DIR__ . '/DBModel/modelLink.php';

    $allReviews = getShownReviews();

    $results = '';
    $text = '';



    if (isset($_POST)){
        $text = filter_input(INPUT_POST, "textHolder");
        $datetime = new DateTime();
        $datetime = $datetime->format('Y\-m\-d\ h:i:s');
        if(!empty($text)){
            $exists = getOneReview($text);
            if ($exists = " "){
                addReview($text, $datetime);
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
    <link rel="stylesheet" href="Stylesheets/style.css" type="text/css">
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

    </style>
    
</head>
<body>
    <div>
    <?php include 'includes/header.php';?>
        <div class="row">
                <div class="col-4">
                      
                </div>
                <div class="col-4 text-center">
                    <h2>Reviews</h2>
                </div>
        </div>
        <div class="row text-center" style="padding-top: 30px; padding-bottom:30px;">
            <div class="col-4">
                      
            </div>
            <div class="col-4 text-center logbtns">
                <button class="custom-btn btn-14" style="display:inline;width: 300px;"  id="Reviewbtn">
                    Leave Review
                </button>
            </div>
        </div>
        <div class="row" >
            <div class="col-2">
                      
                      </div>
                      <div class="col-8 text-center"  style="display:none" id="hiddenarea">
                          <script>
                            tinymce.init({
                                selector: 'textarea',
                                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | image | removeformat',
                                tinycomments_mode: 'embedded',
                                tinycomments_author: 'Author name',
                                mergetags_list: [
                                { value: 'First.Name', title: 'First Name' },
                                { value: 'Email', title: 'Email' },
                                ],
                                
                            });
                        </script>
                        <textarea >
                            Leave Review Here!
                        </textarea>
                        
                        
                        
                      </div>
        


        </div>
        <div class="row text-center" style="display:none" id="hiddencheck1">
            <div class="col-4" class="display: block">            
            </div>
            <div class="col-4 text-center" style="padding-top:30px;padding-bottom:30px; margin-left:auto;margin-right:auto;">
                <input type="checkbox" name="check1" id="check1">
                <label for="check1">I acknowledge that the image used contains only my child </label><br>
                <input type="checkbox" name="check2" id="check2">
                <label for="check2">I allow the use of this photo and review to be posted online </label>
            </div>
        </div>
        <div class="row text-center" style="display:none" id="hiddensub">
            <div class="col-4" class="display: block">            
            </div>
            <div class="col-4 text-center" style="padding-top:30px;padding-bottom:30px; margin-left:auto;margin-right:auto;">
                <form method="POST" id="ReviewMCE" name="uploadForm">
                    <input type="hidden" name="textHolder" id="TinyMceTxt">
                    <button class="custom-btn btn-14">
                        Submit
                    </button>

                </form>
                
            </div>
            
        </div>
        <div class = "row text-center">
            <h3><?= $results;?></h3>
        </div>
        <div>

        </div>
        <div class="row text-center">
            <div class="col-4">

            </div>
            <div class="col-4">
                <h2>All Reviews</h2>
            </div>
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
        <footer class="row footextra Layout container">
            <?php include 'includes/footer.php';?>
        </footer>

        
        
        
        
    </div>
    <div>

    </div>
    <div>

    </div>
    
    <script>
        var booten = document.querySelector(`#Reviewbtn`).addEventListener(`click`,(e) =>{
            var hidden = document.querySelector(`#hiddensub`).style.display = "block"
            var hiddenarea = document.querySelector(`#hiddenarea`).style.display = "inline"
            var check1 = document.querySelector(`#hiddencheck1`).style.display ="inline"
            var boot = document.querySelector(`#Reviewbtn`).style.display = "none"
            
            
            
        })
        var subbtn = document.querySelector(`#hiddensub`).addEventListener(`click`, (e) =>{
                let checkb1 = document.querySelector(`#check1`)
                let checkb2 = document.querySelector(`#check2`)
                if (checkb1.checked == true && checkb2.checked == true){
                    var text = tinymce.activeEditor.getContent()
                    if (text != "<p>Leave Review Here!</p>" && text != ""){
                        console.log(text)
                        inpi = document.querySelector(`#TinyMceTxt`)
                        inpi.value = text
                        form = document.querySelector(`#ReviewMCE`)
                        console.log(form)
                        form.submit()
                        
                        
                        

                        

                        
                        
                    }
                    
                }
                
                
            })
        
    
    
    </script>
    
</body>
</html>