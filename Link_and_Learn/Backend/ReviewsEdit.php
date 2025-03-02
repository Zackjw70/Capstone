<?php
    session_start();

    include __DIR__ . '/../DBModel/modelLink.php';

    $perm = $_SESSION['perm'];
    if($perm < 1){
        header('Location: ../home.php');
    }

    if(isset($_GET['reviewid'])){
        $id = filter_input(INPUT_GET, 'reviewid');
        $r = getOneReviewId($id);
        $id = $r['Reviewid'];
        $text = $r['review'];
        
        if(isset($_POST['replacedText'])){
            $newText = filter_input(INPUT_POST, 'replacedText');
            updateReview($id, $newText);
            header('location: ViewReviews.php');
        }
    }
    else{
        header('Location:ViewReviews.php');
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
    <?php include '../includes/backheader.php';?>
    <div>
        <div class="row text-center">
            <div class="col-md-4 offset-md-4">
                <h2 class="head2">Review Edit</h2>
            </div>
        </div>
        <div class="col-md-6 offset-md-3 text-center">
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
        function santitize(textInput){
            var element = document.createElement('div');
            element.innerText = textInput;
            let sanitized = element.innerHTML;
            sanitized = sanitized.replace(/<\/?p>/g, '');

            return sanitized;
        }

        var subButton = document.querySelector(`#editContent`).addEventListener(`click`, (e) =>{
            e.preventDefault()
            form = document.querySelector(`#updateForm`)
            var content = tinymce.activeEditor.getContent(`#updatedContent`)
            replacedTextHidden = document.querySelector(`#replacedText`).value = santitize(content)
            form.submit('updateForm')

        })
    </script>
</body>
</html>