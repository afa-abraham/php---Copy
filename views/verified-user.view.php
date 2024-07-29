<?php require base_path('db/config.php') ; ?>


<?php require('partials/head.php') ?>
<?php if ($_SESSION['user'] ?? false) : ?>
    <?php require('partials/sidebar.php') ?>
    <?php require('partials/nav.php') ?>
    

    <h1>Dashboard</h1>
    <?php if ($roleId !== 2) {
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
    
  


    <?php require('partials/footer.php') ?>
<?php else : require base_path('views/session/create.view.php') ?>

<?php endif ?>