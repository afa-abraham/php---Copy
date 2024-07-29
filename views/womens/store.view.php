<?php
require base_path('db/config.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Collect and sanitize input data

    $name = $conn -> real_escape_string($_POST['full_name']);
    $email = $conn -> real_escape_string($_POST['email']);

    // Set role_id to 2

    $role_id = 2;

    // Default password
    $plain_password = '12345';
    // Hash the password
    $hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);

    // Prepare an SQL statement

    $stmt = $conn -> prepare('INSERT INTO users (full_name,email,password,role_id) VALUES (?,?,?)');
    if($stmt === false) {
        die("Prepare failed: ". $conn-> error);
    }

    // Bind parameters

    $stmt -> bind_param("ssi", $name, $email,$hashed_password, $role_id);

    // Execute the statement
    if ($stmt->execute()){
        echo "New user added successfully with role ID 2!";
    } else {
        echo "Error:" . $stmt->error;
    }

    // Close the statement
    $stmt->close();

}


//Close the connection
$conn-> close();


view('womens/account.view.php');