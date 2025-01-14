<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Lookup</title>
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
    //set for admin permissions. Will kick the user out to login.php if permissions level isnt met
    session_start();
    if(!isset($_SESSION['user']) && $_SESSION['perm'] < 2){
        header ('Location: ../Login.php');
    }

    include __DIR__ . '/../DBModel/modelLink.php';
    $users = getUsers();
    //search fumction accessing ModelLink
    if(isset($_POST['searchname'])){
        $username = filter_input(INPUT_POST, 'username');
        $searchuser = searchUsers($username);
    }

?>

<body class="everyThang">

    <?php include '../includes/adminheader.php'; ?>

    <div class="row text-center" style="margin-top:20px">
    <h2>Users</h2>
    </div>

    <a href="UserEdit.php?action=newuser" style="margin-left: 10%;"><button class="custom-btn btn-14">Add A User</button></a>

    <div class="row text-center">

        <div class="searchwrapper">
            <form method="post" name="searchuser">
                <label>Search User:</label>
                <input type="text" name="username" value="" />

                <button type="submit" class="custom-btn btn-14" name="searchname" style="width:150px" >Search name</button>
                <button type="submit" class="custom-btn btn-14" name="showall" >Show All</button>
            </form>
        </div>
        <!--perm levels: 2 = admin, 1 = owner, 0 = user-->
        <h3>Admins</h3>
        <div class="d-flex justify-content-center">
            <table class="table table-striped table-warning " style="width: auto;">
            <thead>
            </thead>
            <tbody>
            <?php if(isset($_POST['searchname'])){
                foreach ($searchuser as $u):
                    if ($u['perm'] == '2'){ ?>
                        <tr>
                            <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                            <td><?= $u['username']; ?></td>
                            <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                            
                        </tr>
                    <?php 
                    }
                endforeach; 
            }elseif(isset($_POST['showall'])){
                foreach ($users as $u):
                    if ($u['perm'] == '2'){ ?>
                        <tr>
                            <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                            <td><?= $u['username']; ?></td>
                            <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                        </tr>
                    <?php 
                    }
                endforeach;
            } 
            //else is just for initial load of page
            else{
                foreach ($users as $u):
                    if ($u['perm'] == '2'){ ?>
                        <tr>
                            <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                            <td><?= $u['username']; ?></td>
                            <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                        </tr>
                    <?php 
                    }
                endforeach; 
            }?>
            </tbody>
        </table>
        </div>
        
        <!-- Owner and Users section are the exact same just with different permission check-->
        <h3>Owners</h3>
        <div class="d-flex justify-content-center">
        <table class="table table-striped table-warning" style="width: auto;">
            <thead>
            </thead>
            <tbody>
            <?php if(isset($_POST['searchname'])){
                foreach ($searchuser as $u):
                    if ($u['perm'] == '1'){ ?>
                        <tr>
                            <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                            <td><?= $u['username']; ?></td>
                            <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                        </tr>
                    <?php 
                    }
                endforeach; 
            }elseif(isset($_POST['showall'])){
                    foreach ($users as $u):
                        if ($u['perm'] == '1'){ ?>
                            <tr>
                                <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                                <td><?= $u['username']; ?></td>
                                <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                            </tr>
                        <?php 
                        }
                    endforeach;
            } else{
                foreach ($users as $u):
                    if ($u['perm'] == '1'){ ?>
                        <tr>
                            <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                            <td><?= $u['username']; ?></td>
                            <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                        </tr>
                    <?php 
                    }
                endforeach; 
            }?>
            </tbody>
        </table>
        </div>

        <h3>Users</h3>
        <div class="d-flex justify-content-center">
        <table class="table table-striped table-warning" style="width: auto;">
            <thead>
            </thead>
            <tbody>
            <?php if(isset($_POST['searchname'])){
                foreach ($searchuser as $u):
                    if ($u['perm'] == '0'){ ?>
                        <tr>
                            <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                            <td><?= $u['username']; ?></td>
                            <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                        </tr>
                    <?php 
                    }
                endforeach; 
            }elseif(isset($_POST['showall'])){
                foreach ($users as $u):
                    if ($u['perm'] == '0'){ ?>
                        <tr>
                            <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                            <td><?= $u['username']; ?></td>
                            <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                        </tr>
                    <?php 
                    }
                endforeach;
            } else{
                foreach ($users as $u):
                    if ($u['perm'] == '0'){ ?>
                        <tr>
                            <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                            <td><?= $u['username']; ?></td>
                            <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                        </tr>
                    <?php 
                    }
                endforeach; 
            }?>
            </tbody>

        </table>
        </div>
        <div>
            &nbsp;
        </div>
        
    </div>
</body>
</html>