<?php require('partials/head.php') ?>
<?php if ($_SESSION['user'] ?? false) : ?>

    <?php require('partials/sidebar.php') ?>
    <?php require('partials/nav.php') ?>


    <?php if ($roleId != 3) {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: 'You have no access to this page.'
        }).then(function() {
            window.history.back(); // Go back to the previous page
        });
      </script>";


        exit;
    } ?>


    <main>


        <div class="text-center">
            <h1>WELCOME</h1>
            <h5>To use the Dashboard, please verify your account!</h5>
        </div>
    </main>




    <?php require('partials/footer.php') ?>

<?php endif ?>