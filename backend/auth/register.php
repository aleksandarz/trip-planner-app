<?php
    // Inicijalizacija konekcije na bazu koristeći mysqli
    require_once "../config/conn.php"; 

    // Provera da li je zahtev poslat POST metodom
    if ($_SERVER['REQUEST_METHOD'] != 'POST') 
    {
        echo "Podaci moraju biti poslati POST metodom!";
        exit;
    }

    // Provera da li su sva polja postavljena u POST zahtevu
    if (!isset($_POST["username"]) || !isset($_POST["email"]) || !isset($_POST["password"])) 
    {
        echo "Sva polja su obavezna!";
        exit;
    }

    // Sanitizacija podataka
    $username = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Pripremi i izvrši upit
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === true) 
    {
        echo "Registracija uspešna!";
    } 
    else 
    {
        echo "Greška: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    
?>
