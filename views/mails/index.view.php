<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>


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