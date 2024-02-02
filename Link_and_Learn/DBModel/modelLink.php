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

function searchUsers($username){
    global $db;
    $binds = array();

    $sql = "SELECT * FROM users WHERE 0=0";
    if ($username != "") {
        $sql .= " AND username Like :username";
        $binds['username'] = '%'.$username.'%';
    }

    $results = array();
    $stmt = $db->prepare($sql);
    if ($stmt->execute($binds) && $stmt->rowCount() > 0){
        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    return ($results);
}

function addUsers ($username, $logpassword, $perm){
    global $db;
    $result = "";
    $stmt = $db->prepare("INSERT INTO users set username = :un, logpassword = :lp, perm = :pm");

    $binds = array(
        ":un" => $username,
        ":lp" => $logpassword,
        ":pm" => $perm
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = 'Data Added';
    }

    return ($result);
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

function searchChangeLog($username, $infoid, $imageid){
    global $db;
    $binds = array();

    $sql = "SELECT * FROM changelog WHERE 0=0";
    if ($username != "") {
        $sql .= " AND username Like :username";
        $binds['username'] = '%'.$username.'%';
    }

    if ($infoid != "") {
        $sql .= " AND infoid Like :infoid";
        $binds['info'] = '%'.$infoid.'%';
    }

    if ($imageid != "") {
        $sql .= " AND imageid Like :imageid";
        $binds['imageid'] = '%'.$imageid.'%';
    }

    $results = array();
    $stmt = $db->prepare($sql);
    if ($stmt->execute($binds) && $stmt->rowCount() > 0){
        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
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
    if ($client != "") {
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

function login($user,$pass){
    global $db;
    $results = [];
    $stmt = $db ->prepare("SELECT * FROM users WHERE username = :user ANd logpassword = :pass");
    $stmt->bindValue(':user', $user);
    $stmt->bindValue(':pass', $pass);

    if ($stmt->execute()&& $stmt->rowCount() > 0)
            {$results = $stmt->fetch(PDO::FETCH_ASSOC);
            
        }
    return ($results);
}

function searchLoginAttempts($username){
    global $db;
    $binds = array();

    $sql = "SELECT * FROM loginattempts WHERE 0=0";
    if ($username != "") {
        $sql .= " AND username Like :username";
        $binds['username'] = '%'.$username.'%';
    }

    $results = array();
    $stmt = $db->prepare($sql);
    if ($stmt->execute($binds) && $stmt->rowCount() > 0){
        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    return ($results);
}

?>

