<?php
    // Inicijalizacija konekcije na bazu koristeći mysqli
    require_once __DIR__ . "/../config/conn.php"; 

    // Provera da li je zahtev poslat POST metodom
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
    {
        echo "Podaci moraju biti poslati POST metodom!";
        exit;
    }

    // Provera da li su sva polja postavljena u POST zahtevu
    if (!isset($_POST["email"]) || !isset($_POST["password"])) 
    {
        echo "Sva polja su obavezna!";
        exit;
    }

    // Sanitizacija podataka
    $email = filter_var($_POST["password"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    // Priprema SQL upita sa parametrima
    $sql = "SELECT * FROM users WHERE email = ?";

    // Priprema izjave
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Greška u pripremi upita: " . $conn->error);
    }

    // Bind parametar (s za string)
    $stmt->bind_param("s", $email); // "s" označava da je email string

    // Izvršenje upita
    $stmt->execute();

    // Dobijanje rezultata
    $result = $stmt->get_result();

    // Proveri da li postoji korisnik sa tim emailom
    if ($result->num_rows > 0) 
    {
        // Ako postoji, preuzmi korisničke podatke
        $user = $result->fetch_assoc();

        // Proveri da li se lozinka poklapa
        if (password_verify($password, $user["password"])) 
        {
            // Ako je lozinka tačna, započni sesiju
            session_start();
            $_SESSION["user_id"] = $user["user_id"];
            echo "Login uspešan!";  // Možeš poslati korisnički ID ili neku poruku
        } 
        else 
        {
            echo "Pogrešan email ili lozinka.";
        }
    } 
    else 
    {
        echo "Korisnik sa tim email-om ne postoji.";
    }

    // Zatvori pripremljenu izjavu
    $stmt->close();

    // Zatvori konekciju
    $conn->close();
    
?>
