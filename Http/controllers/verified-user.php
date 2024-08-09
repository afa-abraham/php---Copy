<?php

require base_path('db/config.php');

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
            $_SESSION['user_id'] = $user['id'];
            break; // Exit the loop once the user is found
        }
    }

    // Free result set
    mysqli_free_result($result);
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

$user_id = $_SESSION['user_id'];

//Inbox Query
$sql = "SELECT (mails.id) as id, mails.thread_id, mails.body,mails.created_at, CONCAT(sender.fname, ' ', sender.lname) AS sender_name, sender.profile_image AS sender_image 
        FROM mails 
        JOIN users AS sender ON mails.sender_id = sender.id 
        WHERE mails.receiver_id = ? 
        AND mails.created_at = (
                SELECT MAX(m.created_at)
                FROM mails m
                WHERE m.thread_id = mails.thread_id
            )
        ORDER BY 
            mails.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Clients Query
$sql = "SELECT * from clients where id = ?";

$stmt = $conn->prepare($sql);
if(!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$id = $_GET['id'];
$stmt->bind_param("i",$id);
// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if a record was found
if ($result->num_rows === 0) {
    die("No record found.");
}

// Fetch the result
$client = $result->fetch_assoc();


view('verified-user.view.php', [
    'result' => $result
]);


// Clean up
$stmt->close();
$conn->close();