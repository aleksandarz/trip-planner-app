<?php
    require_once __DIR__ . "../config/conn.php";

    // Provera da li je ID putovanja postavljen za brisanje
    if (isset($_GET['id'])) {
        $trips_id = $_GET['id'];

        // Priprema SQL upita za brisanje
        $sql = "DELETE FROM trips WHERE trips_id = ?";

        // Priprema upita
        if ($stmt = $conn->prepare($sql)) 
        {
            // Bind parametar
            $stmt->bind_param("i", $trips_id);

            // Izvršenje upita
            if ($stmt->execute()) 
            {
                echo "Putovanje uspešno obrisano!";
            } 
            else 
            {
                echo "Greška prilikom brisanja putovanja: " . $stmt->error;
            }

            // Zatvaranje izjave
            $stmt->close();
        } 
        else 
        {
            echo "Greška u pripremi upita: " . $conn->error;
        }
    }
?>
