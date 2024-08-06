<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<div class="card mb-3 w-75">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="ms-3">
                <h5 class="card-title"><?= htmlspecialchars($inbox['sender_name']) ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($inbox['created_at']); ?></h6>
            </div>
            <div class="w-75 bg-light p-3 d-none">
                <?= html_entity_decode($inbox['body']) ?>
            </div>
        </div>
        <div class="border">
            <p class="card-text mt-3">&nbsp;&nbsp;<?php echo nl2br(html_entity_decode($inbox['body'])); ?></p>
        </div>
        <div class="mt-3">
            <h6>Attachments:</h6>
            <ul class="list-unstyled">
                    <li>
                        <embed class="attachment-img my-1" src="" width="150px"><br>
                        <a href="uploads/" target="_blank"><i class="fa fa-paperclip" aria-hidden="true"></i> </a>
                    </li>
            </ul>
        </div>
    </div>
</div>
<div class="card mb-3 w-75">
    <div class="card-body">
        <h5 class="card-title">Reply</h5>
        <form method="POST" action="send_mail.php" enctype="multipart/form-data">
            <input type="hidden" name="receiver_email" value="<?php echo htmlspecialchars($last_sender_email); ?>">
            <input type="hidden" name="thread_id" value="<?php echo $thread_id; ?>">
            <input type="hidden" class="form-control" id="subject" name="subject" value="<?php echo htmlspecialchars($last_subject); ?>" required>

            <!-- @ User Suggestions Dropdown -->
            <ul id="mention-suggestions" class="list-group position-relative"></ul>

            <input type="hidden" name="body" id="hidden-body">

            <div id="message-body" class="form-control message-content" contenteditable="true" name="body" style="height:10rem">

            </div>

            <label for="attachments">Attachments:</label>
            <input class="form-control" type="file" name="attachments[]" id="attachments" multiple><br>
            <button type="submit" class="btn btn-primary mt-3">Send</button>
            <button type="submit" name="save_as_draft" class="btn btn-secondary mt-3">Finish Later</button>
            <a class="btn btn-danger text-decoration-none mt-3" href="dashboard.php">Exit</a>
        </form>
    </div>
</div>







<?php require base_path('views/partials/footer.php') ?>