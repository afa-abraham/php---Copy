<?php require('partials/head.php') ?>
<?php require('partials/sidebar.php') ?>
<?php require('partials/nav.php') ?>

<?php if ($roleId != 1): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: <?= json_encode($roleId == 3 ? "Please verify your account first" : "You have no access to this page"); ?>
        }).then(function() {
            window.history.back(); // Go back to the previous page
        });
    </script>
    <?php exit; ?>
<?php endif; ?>

<main>

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <h1>Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Facebook Link</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <th scope="row"><?= htmlspecialchars($user['id']) ?></th>
                                    <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                                    <td><?= htmlspecialchars($user['age']) ?></td>
                                    <td><?= htmlspecialchars($user['fb_link']) ?></td>
                                    <td><?= htmlspecialchars(($user['role_id']) === 1 ? "Moderator" : "User") ?></td>
                                    <td><?= htmlspecialchars($user['mobile']) ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>



<?php require('partials/footer.php') ?>