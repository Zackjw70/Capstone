<?php
    session_start();

    include __DIR__ . '/DBModel/modelLink.php';
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
        h2{
            font-family: "Architects Daughter", cursive;
            font-weight: 400;
            font-style: normal;
            color:#B93836;
            font-size:50px;
            margin-top:50px;
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

    </style>
    
</head>
<body>
    <div>
        <div class="row headerrow">
            <div class="col-2 text-start">
                <a href="home.php">
                    <img src="images/Link-up_and_Learn_Logo.png" alt="Home" class="logobtn">
                </a>
            </div>
            <div class="col-8 text-center">
                <h1>Link up and Learn</h1>
            </div>
            <div class="col-2 text-center logbtns">
                <?php if(isset($_SESSION['user'])): ?>
                    <h3 class="username"><?= $_SESSION['user']; ?></h3>
                    <a href="Logout.php">
                <button class="custom-btn btn-14 logoutbtn">
                    Logout
                </button>
                </a>
                <?php else: ?>
                    <h3 class="username">Guest</h3>
                <a href="Login.php">
                <button class="custom-btn btn-14 logoutbtn" id="loginbtn">
                    Login
                </button>
                </a>
                <?php endif; ?>
            </div>

        </div>
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
            <div class="col-4 text-center">
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
                                plugins: 'tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
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
        <div class="row text-center" style="display:none" id="hiddensub">
            <div class="col-4" class="display: block">            
            </div>
            <div class="col-4 text-center" style="padding-top:30px;padding-bottom:30px; margin-left:auto;margin-right:auto;">
                <button class="custom-btn btn-14">
                    Submit
                </button>
            </div>
        </div>
        
        <div>

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
    
    <script>
        var booten = document.querySelector(`#Reviewbtn`).addEventListener(`click`,(e) =>{
            var hidden = document.querySelector(`#hiddensub`).style.display = "block"
            var hiddenarea = document.querySelector(`#hiddenarea`).style.display = "inline"
            var boot = document.querySelector(`#Reviewbtn`).style.display = "none"
            
            
            
        })
        var subbtn = document.querySelector(`#hiddensub`).addEventListener(`click`, (e) =>{
                var text = tinymce.activeEditor.getContent()
                console.log(text)
                
            })
    
    
    </script>
    
</body>
</html>