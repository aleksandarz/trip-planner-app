<?php
    require_once __DIR__ . "../config/conn.php";

    // SQL upit za prikaz svih putovanja
    $sql = "SELECT * FROM trips";
    $result = $conn->query($sql);

    // Provera da li postoji neki rezultat
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc()) 
        {
            echo "Trip ID: " . $row["trips_id"] . "<br>";
            echo "User ID: " . $row["user_id"] . "<br>";
            echo "Destination: " . $row["destination"] . "<br>";
            echo "Start Date: " . $row["start_date"] . "<br>";
            echo "End Date: " . $row["end_date"] . "<br>";
            echo "Budget: " . $row["budget"] . "<br>";
            echo "Notes: " . $row["notes"] . "<br><br>";
        }
    } 
    else 
    {
        echo "Nema putovanja.";
    }

    $conn->close();
?>
