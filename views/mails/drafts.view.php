<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<div class="container-fluid d-flex flex-column align-items-center bg-dark text-light">
    <h3 class="my-3">Drafts</h3>

    <?php if ($result->num_rows > 0) : ?>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>To</th>
                    <th>Subject</th>
                    <th>Body</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($draft = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($draft['receiver_name']); ?></td>
                        <td><?php echo htmlspecialchars($draft['subject']); ?></td>
                        <td><?php echo htmlspecialchars($draft['body']); ?></td>
                        <td>
                            <a href="edit_draft.php?draft_id=<?php echo $draft['id']; ?>" class="btn btn-primary">Edit Draft</a>
                            <span><|></span>
                            <a href="../controller_process/delete_draft.php?draft_id=<?php echo $draft['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No drafts found.</p>
    <?php endif; ?>
</div>


<?php require base_path('views/partials/footer.php') ?>