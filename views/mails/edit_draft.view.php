<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<div class="container-fluid d-flex flex-column align-items-center bg-dark text-light">

<center>
<h3 class="my-3">Edit Draft</h3>

<form method="POST" action="edit_draft.php?draft_id=<?php echo $draft_id; ?>">

    <input class="form-control" type="email" placeholder="Email Address" name="receiver_email" id="receiver_email" value="<?php echo htmlspecialchars($receiver_email); ?>" required><br>

    <input class="form-control" type="text" placeholder="Subject" name="subject" id="subject" value="<?php echo htmlspecialchars($draft['subject']); ?>" ><br>

    <textarea class="form-control" name="body" placeholder="Message..." id="body" ><?php echo htmlspecialchars($draft['body']); ?></textarea><br>

    <button class="btn btn-primary mb-3" type="submit">Send</button>
    <button type="submit" name="save_as_draft" class="btn btn-secondary mb-3">Finish Later</button>
</form>

</center>

</div>

<?php require base_path('views/partials/footer.php') ?>