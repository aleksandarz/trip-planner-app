<?php
    require_once __DIR__ . "/../config/conn.php"; 

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
    {
        echo "Request must be POST!";
        exit;
    }

    if (empty($_POST)) 
    {
        echo "No data received!";
        exit;
    }

    var_dump($_POST); // Debugging

    if (!isset($_POST["username"], $_POST["email"], $_POST["password"])) 
    {
        echo "All fields are required!";
        exit;
    }

    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        echo "Invalid email format!";
        exit;
    }

    if (strlen($password) < 6 || strlen($password) > 16) 
    {
        echo "Password must be between 6 and 16 characters.";
        exit;
    }

    // Provera da li email već postoji
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) 
    {
        echo "Email is already taken!";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) 
    {
        echo "success";
    } 
    else 
    {
        echo "Database error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
?>
