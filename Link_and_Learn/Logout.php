<?php 

session_start();
        include __DIR__ . '/model/modelGames.php';

        session_unset(); 
        session_destroy(); 

        header('Location: home.php');
        ?>