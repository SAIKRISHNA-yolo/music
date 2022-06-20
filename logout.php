<?php
// Initialize the session
require 'session.php';
Logout();

// Redirect to login page
header("location: index.php");
exit;
?>