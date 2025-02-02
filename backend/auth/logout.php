<?php

    require_once __DIR__ . "../config/conn.php";
    // Pokreni sesiju
    session_start();

    // Proveri da li je korisnik ulogovan
    if (isset($_SESSION["user_id"])) 
    {
        // Uništi sesiju i loguj korisnika
        session_unset();
        session_destroy();
        echo "Logout uspešan!";
    } 
    else
    {
        echo "Korisnik nije ulogovan.";
    }

?>
