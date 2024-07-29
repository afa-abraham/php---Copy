<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<div class="container-fluid d-flex flex-column align-items-center bg-dark text-light">
    <center>
        <h3 class="my-3">New Message</h3>
        <form method="POST" action="/mails/store">
            <input class="form-control" type="email" placeholder="Email Address" name="receiver_email" id="receiver_email" required><br>
            <input class="form-control" type="text" placeholder="Subject" name="subject" id="subject"><br>
            <textarea class="form-control" name="body" placeholder="Message..." id="body"></textarea><br>
            <input type="hidden" name="thread_id" value="<?php echo $_GET['thread_id'] ?? ''; ?>">
            <button class="btn btn-primary mb-3" type="submit">Send</button>
            <button type="submit" name="save_as_draft" class="btn btn-secondary mb-3">Finish Later</button>
            <a class="btn btn-danger text-decoration-none mb-3" href="/mails/inbox">Discard</a>
        </form>
    </center>
</div> 


<?php require base_path('views/partials/footer.php') ?>