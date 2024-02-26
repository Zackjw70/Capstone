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
        ":lp" => crypt($logpassword, '$5$'),
        ":pm" => $perm
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = 'Data Added';
    }

    return ($result);
}

function OneUser($user){
    global $db;

    $result = [];
    $stmt = $db->prepare("SELECT * FROM users WHERE username=:un");
    $stmt->bindvalue(':un', $user);
    if ($stmt->execute() && $stmt ->rowCount() > 0){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return ($result);
}

function UpdateUser($username, $logpassword, $perm){
    global $db;

    $results = "";
    $stmt = $db->prepare("UPDATE users SET logpassword = :lp, perm = :pm WHERE username=:un" );

    $binds = array(
        ":un" => $username,
        ":lp" => $logpassword,
        ":pm" => $perm
    );

    if ($stmt->execute($binds) & $stmt->rowCount() > 0){
        $results = "Data Updated";
    }
    
    return($results);
    
}

function NoEncryptUpdate($username, $perm){
    global $db;

    $results = "";
    $stmt = $db->prepare("UPDATE users SET logpassword = logpassword, perm = :pm WHERE username=:un");

    $stmt->bindValue(':un', $username);
    $stmt->bindValue(':pm', $perm);
    /*$binds = array(
        ":un" => $username,
        ":pm" => $perm
    );*/

    if ($stmt->execute() & $stmt->rowCount() > 0){
        $results = "Data Updated";
    }

    return($results);
    
}

function DeleteUser($user){
    global $db;

    $results = "Data was not Deleted";
    $stmt = $db->prepare("DELETE FROM users WHERE username=:un");

    $stmt->bindvalue(':un', $user);
    if ($stmt->execute() && $stmt->rowCount() > 0){
        $results = "Data Deleted";
    }

    return($results);
}


//All functions for ChangeLog Table

function getChangeLog(){
    global $db;
    $results = [];
    $sqlstring = $db ->prepare("SELECT changeid, infoid, imageid, changetime, username, successful FROM changelog ORDER BY changetime");
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
function getOneReview($review){
    global $db;
    $results = [];
    $stmt = $db ->prepare("SELECT * FROM reviews WHERE review = :r");
    $stmt->bindValue(':r', $review);
    if ($stmt -> execute() && $stmt ->rowCount() > 0){
        $results = $stmt -> fetchALL(PDO::FETCH_ASSOC);
    }

    return ($results);
}

function getShownReviews(){
    global $db;
    $results = [];
    $sqlstring = $db ->prepare("SELECT * FROM reviews WHERE shows = 0 ORDER BY datesubmitted");
    if ($sqlstring -> execute() && $sqlstring ->rowCount() > 0){
        $results = $sqlstring -> fetchALL(PDO::FETCH_ASSOC);
    }

    return ($results);
}
function getShown3(){
    global $db;
    $results = [];
    $sqlstring = $db ->prepare("SELECT * FROM reviews WHERE shows = 0 ORDER BY datesubmitted DESC limit 3");
    if ($sqlstring -> execute() && $sqlstring ->rowCount() > 0){
        $results = $sqlstring -> fetchALL(PDO::FETCH_ASSOC);
    }

    return ($results);
}

function addReview($text, $time){
    global $db;
    $result = "";
    $stmt = $db->prepare("INSERT INTO reviews set review = :r, datesubmitted = :ds");

    $binds = array(
        ":r" => $text,
        ":ds" => $time,
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = 'Data Added';
    }

    return ($result);
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
    $stmt->bindValue(':pass', crypt($pass,'$5$'));

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



//Functions for page Layouts

function getContent($section){
    global $db;
    $binds = array();
    $results = "";

    $stmt = $db->prepare("SELECT * FROM pagelayouts WHERE section = :s");
    $stmt->bindValue(':s', $section);

    if($stmt->execute() && $stmt->rowCount() > 0){
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $results = [];
    }
    return($results);
}
function contentDelete($id){
    global $db;

    $results = "Content was NOT deleted";

    $stmt = $db->prepare("DELETE FROM pagelayouts WHERE infoid=:id");
    $stmt->bindValue(':id', $id);

    if($stmt->execute() && $stmt->rowCount() > 0){
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return($results);
}
function getOneContent($text){
    global $db;
    $results = [];
    $stmt = $db ->prepare("SELECT * FROM pagelayouts WHERE contentText = :t");
    $stmt->bindValue(':t', $text);
    if ($stmt -> execute() && $stmt ->rowCount() > 0){
        $results = $stmt -> fetchALL(PDO::FETCH_ASSOC);
    }

    return ($results);
}
function addContent($text, $section, $now){
    global $db;
    $result = "";
    $stmt = $db->prepare("INSERT INTO pagelayouts set contentText = :t, lastedited = :le, section = :s");

    $binds = array(
        ":t" => $text,
        ":le" => $now,
        ":s" => $section,
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = 'Data Added';
    }

    return ($result);
}

?>

