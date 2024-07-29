<?php
require base_path('db/config.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Collect and sanitize input data


    $uname = $conn -> real_escape_string($_POST['username']);
    $name = $conn -> real_escape_string($_POST['full_name']);
    $email = $conn -> real_escape_string($_POST['email']);

    // Set role_id to 2

    $role_id = 2;

    // Default password
    $plain_password = '12345';
    // Hash the password
    $hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);

    // Prepare an SQL statement

    $stmt = $conn -> prepare('INSERT INTO users (full_name,username,email,password,role_id) VALUES (?,?,?,?,?)');
    if($stmt === false) {
        die("Prepare failed: ". $conn-> error);
    }

    // Bind parameters

    $stmt -> bind_param("ssssi", $name,$uname, $email,$hashed_password, $role_id);

    // Execute the statement
    if ($stmt->execute()){
        echo "New user added successfully ";
    } else {
        echo "Error:" . $stmt->error;
    }

    // Close the statement
    $stmt->close();

}


//Close the connection
$conn-> close();

redirect('/womens');
