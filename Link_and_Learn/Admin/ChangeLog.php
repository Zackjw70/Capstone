<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChangeLog</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../Stylesheets/style.css" type="text/css">
    <script src="https://cdn.tiny.cloud/1/vq1rq2p69wax28njpht11pigfyry07aksn56iwrrgnkrhe3x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        .row{
            width:100%;
        }

    </style>
</head>

<?php
    session_start();
    if(!isset($_SESSION['user']) && $_SESSION['perm'] < 2){
        header ('Location: ../Login.php');
    }

    include __DIR__ . '/../DBModel/modelLink.php';

    $getchange = getChangeLog();

    if(isset($_POST['search'])){
        $username = filter_input(INPUT_POST, 'username');
        $section = filter_input(INPUT_POST, 'section');
        $searchchange = searchChangeLog($username, $section);
    }


?>
<body class="everyThang">
    <?php include '../includes/adminheader.php'; ?>
    
    <div class="row text-center">
    <h2>Change Log</h2>
    </div>
    <div class="searchcontainer">
        <div class="row text-center" style="margin-bottom: 10px">
            <form method="post" name="searchchange">
                <label>Search User:</label>
                <input type="text" name="username" value=""/>
                <label>Section:</label>
                <input type="text" name="section" value=""/>
                <input type="submit" name="search" value="Search" />
                <input type="submit" name="showall" value="Show All" />
            </form>
        </div>
        <div class="d-flex justify-content-center">
        <table class="table table-striped table-warning " style="width: auto;">
            <thead>
                <tr>
                    <th>Section</th>
                    <th>Date</th>
                    <th>Username</th>
                    <th>Success</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($_POST['search'])){
                    foreach($searchchange as $s):?>
                    <tr>
                        <td><?= $s['section']?></td>
                        <td><?= $s['changetime']?></td>
                        <td><?= $s['username']?></td>
                        <?php if($s['successful'] == "Pass"): ?>
                                    <td style="color:#2AAE2F">
                                        Pass
                                    </td>
                                <?php else:?>
                                    <td style="color:#F81D1D">
                                        Fail
                                    </td>
                                <?php endif;?>
                    </tr>
                    <?php endforeach;
                } elseif(isset($_POST['showall'])){
                    foreach($getchange as $g):?>
                    <tr>
                        <td><?= $g['section']?></td>
                        <td><?= $g['changetime']?></td>
                        <td><?= $g['username']?></td>
                        <?php if($g['successful'] == "Pass"): ?>
                                    <td style="color:#2AAE2F">
                                        Pass
                                    </td>
                                <?php else:?>
                                    <td style="color:#F81D1D">
                                        Fail
                                    </td>
                                <?php endif;?>
                    </tr>
                    <?php endforeach;
                } else{
                    foreach($getchange as $g):?>
                    <tr>
                        <td><?= $g['section']?></td>
                        <td><?= $g['changetime']?></td>
                        <td><?= $g['username']?></td>
                        <?php if($g['successful'] == "Pass"): ?>
                                    <td style="color:#2AAE2F">
                                        Pass
                                    </td>
                                <?php else:?>
                                    <td style="color:#F81D1D">
                                        Fail
                                    </td>
                                <?php endif;?>
                    </tr>
                    <?php endforeach;
            }?>
            </tbody>

        </table>
        </div>
    </div>
</body>
</html>