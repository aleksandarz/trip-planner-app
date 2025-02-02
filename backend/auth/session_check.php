<?php

    require_once __DIR__ . "../config/conn.php";
    // session_check.php
    session_start(); // Pokreni sesiju

    // Provera da li je korisnik ulogovan
    if (!isset($_SESSION["user_id"])) 
    {
        // Ako korisnik nije ulogovan, preusmeri ga na login stranicu
        header("Location: login.php");
        exit;
    }

?>
