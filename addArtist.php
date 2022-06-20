<?php
require 'config.php';
require "session.php";

$val = isLoggedIn();

if ($val == false) {
    header("location: newSong.php");
}

if(isset($_POST)){
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $bio = $_POST['bio'];

    $stmt = $mysqli->prepare("INSERT INTO artists (name, dob, bio) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $dob, $bio);

    if (!$stmt->execute()) {
        echo "<script>alert('Try Again!');</script>";
        header("refresh:3;url=newSong.php");
        exit;
    } else {
        header("Location: newSong.php");
    }
}

?>