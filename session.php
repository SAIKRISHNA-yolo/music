<?php
session_start();

function isLoggedIn() {
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        // echo implode(",", $_SESSION);
        return true;
    }
    return false;
}

function userStatus($id, $username){
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $username; 
}

function userName(){
    if (isset($_SESSION["username"])) {
        return $_SESSION["username"];
    }
    return "";
}

function userID(){
    if (isset($_SESSION["id"])) {
        return $_SESSION["id"];
    }
    return "";
}

function Logout(){
    // Initialize the session
    session_start();
    $_SESSION = array();
    session_destroy();
}

?>