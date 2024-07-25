<?php

require('config.php');

// SQL query
$sql = "SELECT * FROM users";

// Execute query
$result = mysqli_query($conn, $sql);

// Check if query executed successfully
if ($result) {
    // Fetch all rows into an associative array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Loop through the fetched users array
    foreach ($users as $user) {
        // Check if the user's email matches the email in the session
        if ($user['email'] === $_SESSION['user']['email']) {
            $_SESSION['unique_id'] = $user['id'];
            break; // Exit the loop once the user is found
        }
    }

    // Free result set
    mysqli_free_result($result);

    // Close connection
    mysqli_close($conn);
} else {
    echo "Error executing query: " . mysqli_error($conn);
}


if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    if (!empty($message)) {
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                    VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
    }
} else {
    header("location: /login");
}
