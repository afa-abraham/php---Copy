<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>

<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>


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
$role_id = $_SESSION['role_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['archive_mail_id'])) {
    $mail_id = $_POST['archive_mail_id'];
    $sql = "UPDATE mails SET archived = 1 WHERE id = ? AND sender_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $mail_id, $user_id);
    $stmt->execute();
    $stmt->close();

    // Reload the page to reflect changes
    header("Location: sent.php");
    exit;
}


$sql = "SELECT mails.*, mail_users.username AS receiver_name, mail_users.profile_image AS receiver_image 
        FROM mails 
        JOIN mail_users ON mails.receiver_id = mail_users.id 
        WHERE mails.sender_id = ? AND mails.sender_deleted = 0 AND mails.archived = 0
        ORDER BY sent_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$isAdmin = ($role_id == 1);

?>

<div class="container-fluid d-flex flex-column align-items-center bg-dark text-light">
    <h1 class="py-3">Sent Emails</h1>
    <table class="table">
        <tr>
            <th>To</th>
            <th>Subject</th>
            <th>Date</th>
            <?php if ($isAdmin) : ?>
                <th>Status</th>
            <?php else : ?>
            <?php endif; ?>
            <th>Actions</th>

        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td>
                    <img src="uploads/<?php echo htmlspecialchars($row['receiver_image']); ?>" class="profile-img rounded-circle" alt="Receiver Image" width="50px">
                    <?php echo htmlspecialchars($row['receiver_name']); ?>
                </td>
                <td><a class="text-decoration-none" href="view_message.php?id=<?php echo $row['id']; ?>&type=inbox"><?php echo htmlspecialchars($row['subject']); ?></a></td>
                <td><?php echo htmlspecialchars($row['sent_at']); ?></td>
                <?php if ($isAdmin) : ?>
                    <td><?php echo $row['is_read'] ? 'Read' : 'Unread'; ?></td>
                <?php else : ?>
                <?php endif; ?>
                <td>
                    <a class="ms-3" href="delete_mail.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?');"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>

                    <a class="ms-1" href="archive_mail.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to archive this message?');"><i class="fa fa-archive text-warning" aria-hidden="true"></i></a>
                </td>
 
            </tr>
        <?php endwhile; ?>
    </table>

</div>

<?php require base_path('views/partials/footer.php') ?>