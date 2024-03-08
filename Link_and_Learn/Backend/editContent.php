<?php
    session_start();
    include __DIR__ . '/../DBModel/modelLink.php';

    


    $perm = $_SESSION['perm'];
    if($perm < 1){
        header('Location: ../home.php');
    }
    if(isset($_GET['infoid'])){
        $id = filter_input(INPUT_GET, 'infoid');
        $c = getOneText($id);
        $id = $c['infoid'];
        $text = $c['contentText'];
        $section = $c['section'];
        
        if(isset($_POST['replacedText'])){
            $newText = filter_input(INPUT_POST, "replacedText");
            $now = new DateTime();
            $now = $now->format('Y\-m\-d\ h:i:s');
            updateSection($id, $newText, $now);
            header('location: HomeEdit.php');
            
            }



    }
    else{
        header('Location:HomeEdit.php');
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
    </head>
    <body class="everyThang">
        <div>
            <?php include '../includes/backheader.php';?>
        </div>
        <div class="row text-center"><h1 class="head2">Edit Content</h1></div>
        <div class="row"><div class="col-md-3">

        </div>
        <div class="col-md-6 text-center">
            <textarea id="updatedContent">
                <?= $text ;?>
            </textarea>
            <form method="post" id="updateForm">
                <input type="hidden" id="replacedText" name="replacedText">
                <button class="custom-btn btn-14 xtraSpacing" id="editContent">Submit</button>
            </form>
        </div>    
                
        </div>
        <script>
            var subButton = document.querySelector(`#editContent`).addEventListener(`click`, (e) =>{
                e.preventDefault()
                form = document.querySelector(`#updateForm`)
                var content = tinymce.activeEditor.getContent(`#updatedContent`)
                replacedTextHidden = document.querySelector(`#replacedText`).value = content
                form.submit('updateForm')
                



            })
        </script>
        
    </body>
    </html>