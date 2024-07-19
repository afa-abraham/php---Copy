<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

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

$user_id = $_SESSION['user_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['archive_mail_id'])) {
    $mail_id = $_POST['archive_mail_id'];
    $sql = "UPDATE mails SET archived = 1 WHERE id = ? AND receiver_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $mail_id, $user_id);
    $stmt->execute();
    $stmt->close();

    // Reload the page to reflect changes
    header("Location: dashboard.php");
    exit;
}


$sql = "SELECT mails.*, mail_users.username AS sender_name, mail_users.profile_image AS sender_image 
        FROM mails 
        JOIN mail_users ON mails.sender_id = mail_users.id 
         WHERE mails.receiver_id = ? AND mails.receiver_deleted = 0 AND mails.archived = 0
        ORDER BY sent_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();



?>


<div class="container-fluid d-flex flex-column align-items-center bg-dark text-light">
    <h1 class="py-3">Inbox</h1>
    <table class="table">
        <tr>
            <th>From</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Actions</th>


        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td>
                    <img src="uploads/<?= htmlspecialchars($row['sender_image']); ?>" class="profile-img rounded-circle" alt="Sender Image" width="50px">
                    <?= htmlspecialchars($row['sender_name']); ?>
                </td>
                <td><a class="text-decoration-none" href="view_message.php?id=<?= $row['id']; ?>&type=inbox"><?= htmlspecialchars($row['subject']); ?></a></td>
                <td><?= htmlspecialchars($row['sent_at']); ?></td>
                <td>

                    <a class="me-1" href="reply_mail.php?receiver_id=<?= $row['sender_id']; ?>&subject=<?= urlencode('Re: ' . $row['subject']); ?>"><i class="fa fa-reply" aria-hidden="true"></i></a>

                    <a class="ms-1" href="delete_mail.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?');"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>

                    <a class="ms-1" href="archive_mail.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to archive this message?');"><i class="fa fa-archive text-warning" aria-hidden="true"></i></a>

                </td>



            </tr>
        <?php endwhile; ?>
    </table>

</div>

<?php require base_path('views/partials/footer.php') ?>