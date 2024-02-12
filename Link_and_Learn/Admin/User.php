<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Stylesheets/style.css" type="text/css">
  <title>Users Page</title>
</head>

<?php
    include __DIR__ . '/../DBModel/modelLink.php';
    $users = getUsers();
?>

<body>

    <a href="UserEdit.php?action=newuser">Add A User</a>


    <div class="container">
        <h3>Admins</h3>
        <table class="users_table">
            <thead>
                <tr>
                    <th>Edit</th>
                    <th>User</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $u):
                if ($u['perm'] == '2'){ ?>
                    <tr>
                        <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                        <td><?= $u['username']; ?></td>
                        <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                    </tr>
                <?php 
                }
            endforeach; ?>
            </tbody>
        </table>

        <h3>Owners</h3>
        <table class="users_table">
            <thead>
            </thead>
            <tbody>
            <?php foreach ($users as $u):
                if ($u['perm'] == '1'){ ?>
                    <tr>
                        <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                        <td><?= $u['username']; ?></td>
                        <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                    </tr>
                <?php 
                }
            endforeach; ?>
            </tbody>
        </table>

        <h3>Users</h3>
        <table class="users_table">
            <thead>
            </thead>
            <tbody>
            <?php foreach ($users as $u):
                if ($u['perm'] == '0'){ ?>
                    <tr>
                        <td><a href="UserEdit.php?action=Update&username=<?=$u['username'];?>">Edit</a></td>
                        <td><?= $u['username']; ?></td>
                        <td><a href="UserEdit.php?action=Delete&username=<?=$u['username'];?>">Delete</a></td>
                    </tr>
                <?php 
                }
            endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>