<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<div class="container-fluid d-flex flex-column align-items-center bg-dark text-light" style="height: 80vh;">


    <form method="POST" action="/mails">
        <label for="receiver_email">To (Email):</label>
        <input class="form-control" type="email" placeholder="email" name="receiver_email" id="receiver_email" required><br>

        <label for="subject">Subject:</label>
        <input class="form-control" type="text" placeholder="subject" name="subject" id="subject" required><br>

        <label for="body">Body:</label>
        <textarea class="form-control" name="body" placeholder="message..." id="body" required></textarea><br>

        <button class="btn btn-primary send" type="submit">Send</button>
    </form>



</div>

<?php require base_path('views/partials/footer.php') ?>
<script>
    document.querySelector('.btn.send').addEventListener('click', function(event) {
        event.preventDefault();
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "Message Sent"
        });
    });


</script>