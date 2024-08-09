<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>


<div class="container-fluid d-flex flex-column align-items-center bg-dark text-light">
    <h3 class="py-3">Message Thread</h3>
    <?php while ($row = $result->fetch_assoc()) : 
        $last_sender_email = $row['sender_email'];
        $last_subject = $row['subject'];
    ?>
        <div class="card mb-3 w-50">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img src="uploads/<?php echo htmlspecialchars($row['sender_image']); ?>" class="profile-img rounded-circle" alt="Sender Image" width="50px">
                    <div class="ms-3">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['sender_name']); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($row['created_at']); ?></h6>
                    </div>
                </div>
                <div class="border">
                <p class="card-text mt-3">&nbsp;&nbsp;<?php echo nl2br(htmlspecialchars($row['body'])); ?></p>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    <div class="card mb-3 w-50">
        <div class="card-body">
            <h5 class="card-title">Reply</h5>
            <form method="POST" action="/mails/store">
                <input type="hidden" name="receiver_email" value="<?php echo htmlspecialchars($last_sender_email); ?>">
                <input type="hidden" name="thread_id" value="<?php echo $thread_id; ?>">
                <div class="form-group">
                    <input type="hidden" type="text" class="form-control" id="subject" name="subject" value="<?php echo htmlspecialchars($last_subject); ?>" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="body" name="body" rows="5" placeholder="Write message here..." ></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Send</button>
                <a name="save_as_draft" class="btn btn-secondary mt-3" href="/mails/inbox">Back</a>
            </form>
        </div>
    </div>
</div>


<?php require base_path('views/partials/footer.php') ?>
