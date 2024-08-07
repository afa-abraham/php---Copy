<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<div class="container-fluid d-flex flex-column align-items-center">
        <center>
            <h3 class="my-3">New Message</h3>
            <form method="POST" action="/mails/store">
                <input class="form-control" type="text" placeholder="Full Name" name="receiver_name" id="receiver_name" required><br>
                <textarea class="form-control" name="body" placeholder="Message..." id="body" required></textarea><br>
                <button class="btn btn-primary mb-3" type="submit">Send</button>
            </form>
        </center>
    </div


<?php require base_path('views/partials/footer.php') ?>