<?php

include (__DIR__ . '/db.php');

//All functions for Users Table

function getUsers(){
    global $db;
    $results = [];
    $sqlstring = $db ->prepare("SELECT username, logpassword, perm FROM users ORDER BY username");
    if ($sqlstring -> execute() && $sqlstring ->rowCount() > 0){
        $results = $sqlstring -> fetchALL(PDO::FETCH_ASSOC);
    }

    return ($results);
}


//All functions for ChangeLog Table

function getChangeLog(){
    global $db;
    $results = [];
    $sqlstring = $db ->prepare("SELECT changeid, infoid, imageid, changetime, username, successful FROM changelog ORDER BY chagetime");
    if ($sqlstring -> execute() && $sqlstring ->rowCount() > 0){
        $results = $sqlstring -> fetchALL(PDO::FETCH_ASSOC);
    }

    return ($results);
}

//All functions for Reviews

function getReviews(){
    global $db;
    $results = [];
    $sqlstring = $db ->prepare("SELECT Reviewid, client, datesubmitted, review, show, hidename FROM reviews ORDER BY datesubmitted");
    if ($sqlstring -> execute() && $sqlstring ->rowCount() > 0){
        $results = $sqlstring -> fetchALL(PDO::FETCH_ASSOC);
    }

    return ($results);
}

function searchReviews($client){
    global $db;
    $binds = array();

    $sql = "SELECT * FROM reviews WHERE 0=0";
    if ($first != "") {
        $sql .= " AND client Like :client";
        $binds['client'] = '%'.$client.'%';
    }

    $results = array();
    $stmt = $db->prepare($sql);
    if ($stmt->execute($binds) && $stmt->rowCount() > 0){
        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    return ($results);
}

//All functions for Login Attempts

function getLoginAttempts(){
    global $db;
    $results = [];
    $sqlstring = $db ->prepare("SELECT Attemptid, username, Attemptedpassword, successful, AttemptTime FROM loginattempts ORDER BY username");
    if ($sqlstring -> execute() && $sqlstring ->rowCount() > 0){
        $results = $sqlstring -> fetchALL(PDO::FETCH_ASSOC);
    }

    return ($results);
}

