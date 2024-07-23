<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errors = [];


$user_id = $_GET['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiver_email = $_POST['receiver_email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    // Lookup receiver_id based on email
    $sql = "SELECT id FROM users WHERE email = ?";
    $result = $db->query($sql, [$receiver_email])->statement->fetch();

    if ($result) {
        $receiver_id = $result['id'];
        $sql = "INSERT INTO mails (sender_id, receiver_id, subject, body) VALUES (?, ?, ?, ?)";
        $params = [$user_id, $receiver_id, $subject, $body];
        $db->query($sql, $params);
    } else {
        echo "Error: User with email " . htmlspecialchars($receiver_email) . " not found.";
    }
}

view("mails/create.view.php", [
    'heading' => 'Create a new message',
    'errors' => []
]);