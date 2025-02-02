<?php

    require_once __DIR__ . "../config/conn.php";

    // Provera da li je forma poslata
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
    {
        echo "Podaci moraju biti poslati POST metodom!";
        exit;
    }
    // Preuzimanje podataka iz forme
    $user_id = $_POST['user_id'];
    $destination = $_POST['destination'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $budget = $_POST['budget'];
    $notes = $_POST['notes'];

    // Priprema SQL upita za unos podataka
    $sql = "INSERT INTO trips (user_id, destination, start_date, end_date, budget, notes) VALUES (?, ?, ?, ?, ?, ?)";

    // Priprema upita
    if ($stmt = $conn->prepare($sql)) 
    {
        // Bind parametri
        $stmt->bind_param("issdss", $user_id, $destination, $start_date, $end_date, $budget, $notes);

        // Izvršenje upita
        if ($stmt->execute()) {
            echo "Putovanje uspešno dodato!";
        } 
        else 
        {
            echo "Greška prilikom dodavanja putovanja: " . $stmt->error;
        }

        $stmt->close();
    } 
    else 
    {
        echo "Greška u pripremi upita: " . $conn->error;
    }


?>

