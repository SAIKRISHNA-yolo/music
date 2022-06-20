<?php

require 'config.php';
require "session.php";

$val = isLoggedIn();

if ($val == false) {
    header("location: newSong.php");
}

if(isset($_POST)){
    $newfilename= date('dmYHis').str_replace(" ", "", basename($_FILES["image"]["name"]));
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./images/" . $newfilename;

    if(isset($_POST['name'])){
        $name = $_POST['name'];
    }

    if(isset($_POST['rate'])){
        $rate = $_POST['rate'];
    }

    if(isset($_POST['date'])){
        $dor = $_POST['date'];
    }
    if(isset($_POST['artist']) && $_POST['artist'] >= 1){
        $artistID = $_POST['artist'];
    }

    $stmt = $mysqli->prepare("INSERT INTO songs (name, releaseDate, artwork, artist_id, rate) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $name, $dor, $newfilename, $artistID, $rate);

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        if ($stmt->errno == 1452){
            echo "<script>alert('Select correct Artist Name');</script>";
            header("refresh:3;url=newSong.php");
            exit;
        } else {
            header("Location: newSong.php");
            exit;
        }
    }else {
        echo $stmt->insert_id;
        echo "Removing";
        if (move_uploaded_file($tempname, $folder)){
            header("Location: welcome.php");
        } else {
            $id = $stmt->insert_id;
            $mysqli->query("DELETE FROM songs WHERE id = $id");
            header('Location: newSong.php');
        }
    }
}
