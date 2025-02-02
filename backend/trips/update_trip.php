<?php
    require_once __DIR__ . "..config/conn.php";

    // Provera da li je ID putovanja postavljen (ako je, onda ćemo da ažuriramo)
    if (isset($_GET['id'])) 
    {
        $trips_id = $_GET['id'];

        // Provera da li je forma poslata
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
        {
            echo "Podaci moraju biti poslati POST metodom!";
            exit;
        }

        // Preuzimanje novih podataka iz forme
        $user_id = $_POST['user_id'];
        $destination = $_POST['destination'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $budget = $_POST['budget'];
        $notes = $_POST['notes'];

        // Priprema SQL upita za ažuriranje
        $sql = "UPDATE trips SET user_id = ?, destination = ?, start_date = ?, end_date = ?, budget = ?, notes = ? WHERE trips_id = ?";

        // Priprema upita
        if ($stmt = $conn->prepare($sql)) 
        {
            // Bind parametri
            $stmt->bind_param("issdssi", $user_id, $destination, $start_date, $end_date, $budget, $notes, $trips_id);

            // Izvršenje upita
            if ($stmt->execute()) 
            {
                echo "Putovanje uspešno ažurirano!";
            } 
            else 
            {
                echo "Greška prilikom ažuriranja putovanja: " . $stmt->error;
            }

            // Zatvaranje izjave
            $stmt->close();
        } 
        else 
        {
            echo "Greška u pripremi upita: " . $conn->error;
        }   
    }

    // Preuzimanje trenutnih podataka o putovanju
    $sql = "SELECT * FROM trips WHERE trips_id = ?";
    if ($stmt = $conn->prepare($sql)) 
    {
        $stmt->bind_param("i", $trips_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $trip = $result->fetch_assoc();
        $stmt->close();
    }
    
    $conn->close();
    
?>
    
        
    

