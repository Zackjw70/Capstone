<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChangeLog</title>
</head>

<?php
    include __DIR__ . '/../DBModel/modelLink.php';

    $getchange = getChangeLog();

    if(isset($_POST['search'])){
        $username = filter_input(INPUT_POST, 'username');
        $infoid = filter_input(INPUT_POST, 'infoid');
        $imageid = filter_input(INPUT_POST, 'imageid');
        $searchchange = searchChangeLog($username, $infoid, $imageid);
    }


?>
<body>
    <h3>Change Log</h3>
    <div class="searchcontainer">
        <div class="searchwrapper">
            <form method="post" name="searchchange">
                <label>Search User:</label>
                <input type="text" name="username" value=""/>
                <label>Info ID:</label>
                <input type="text" name="infoid" value=""/>
                <label>Image ID:</label>
                <input type="text" name="imageid" value=""/>
                <input type="submit" name="search" value="Search" />
                <input type="submit" name="showall" value="Show All" />
            </form>
        </div>
        <table class="changelog">
            <thead>
                <tr>
                    <th>Info ID</th>
                    <th>Image ID</th>
                    <th>Date</th>
                    <th>Username</th>
                    <th>Success</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($_POST['search'])){
                    foreach($searchchange as $s):?>
                    <tr>
                        <td><?= $s['infoid']?></td>
                        <td><?= $s['imageid']?></td>
                        <td><?= $s['changetime']?></td>
                        <td><?= $s['username']?></td>
                        <td><?= $s['successful']?></td>
                    </tr>
                    <?php endforeach;
                } elseif(isset($_POST['showall'])){
                    foreach($getchange as $g):?>
                    <tr>
                        <td><?= $g['infoid']?></td>
                        <td><?= $g['imageid']?></td>
                        <td><?= $g['changetime']?></td>
                        <td><?= $g['username']?></td>
                        <td><?= $g['successful']?></td>
                    </tr>
                    <?php endforeach;
                } else{
                    foreach($getchange as $g):?>
                    <tr>
                        <td><?= $g['infoid']?></td>
                        <td><?= $g['imageid']?></td>
                        <td><?= $g['changetime']?></td>
                        <td><?= $g['username']?></td>
                        <td><?= $g['successful']?></td>
                    </tr>
                    <?php endforeach;
            }?>
            </tbody>

        </table>
    </div>
</body>
</html>