<?php
    require_once 'dbinfo.php';
    //distruggo la sessione e reindirizzo l'utente alla homepage 
    session_start();
    session_destroy();
    header("Location: hw1.php");
    exit;
?>