<?php 
// On démarre la session
    session_start(); 
    // On détruit la session 
    session_destroy(); 
    // On redirige vers index.php
    header('Location:index.php'); 
    die();