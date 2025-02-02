<?php
    // Inicijalizacija konekcije na bazu koristeći mysqli
    require_once __DIR__ . "../config/conn.php";

    // Provera da li je zahtev poslat POST metodom
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
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
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

    // Priprema izjave
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) 
    {
        die("Greška u pripremi upita: " . $conn->error);
    }
    
    // Bind parametri (s za string, d za decimalni, b za binarne podatke, itd.)
    $stmt->bind_param("sss", $username, $email, $password);
    
    // Skrivanje korisničkog unosa za password pre nego što ga sačuvamo (npr. korišćenje bcrypt za hashiranje)
    $password = password_hash($password, PASSWORD_BCRYPT);
    
    // Izvršenje pripremljenog upita
    if ($stmt->execute()) 
    {
        echo "Registracija uspešna!";
    } 
    else
    {
        echo "Greška: " . $stmt->error;
    }
    
    // Zatvaranje pripremljene izjave
    $stmt->close();
    
?>
