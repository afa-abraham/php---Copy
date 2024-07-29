<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<div class="container-fluid d-flex flex-column align-items-center bg-dark text-light">
    <h3 class="py-3">Sent Emails</h3>
    <table class="table">
        <tr>
            <th>To</th>
            <th>Subject</th>
            <th>Date</th>
 
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td>
                    <img src="uploads/<?php echo htmlspecialchars($row['receiver_image']); ?>" class="profile-img rounded-circle" alt="Receiver Image" width="50px">
                    <?php echo htmlspecialchars($row['receiver_name']); ?>
                </td>
                
                <td><a class="text-decoration-none view-message" href="view_message.php?id=<?php echo $row['id']; ?>&type=inbox"><?php echo htmlspecialchars($row['subject']); ?></a></td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
 
                <td>
                    <a class="ms-3" href="../controller_process/delete_mail.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?');"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                    <a class="ms-1" href="../controller_process/archive_mail.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to archive this message?');"><i class="fa fa-archive text-warning" aria-hidden="true"></i></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>


<?php require base_path('views/partials/footer.php') ?>