<?php

    $info = getmain();
    $ownername = $info["ownername"];
    $phone = $info["phone"];
    $email = $info["email"];

?>


<footer class="row footextra">
    <p><?= $ownername?></p>
    <p>Phone: <?= $phone?></p>
    <p>Email: <?= $email?></p>
</footer>