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
    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="php/images/' . $row['img'] . '" alt="">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;
} else {
    header("location: /login");
}
