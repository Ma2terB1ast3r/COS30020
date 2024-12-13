<?php
    // Clears session and redirects to home
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
?>