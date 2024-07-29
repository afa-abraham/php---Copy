<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>


<h1>Add New User</h1>

<form action="/womens/store" method="POST">
    <label for="full_name">Name:</label>
    <input type="text" id="full_name" name="full_name" required><br><br>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    
    <input type="submit" value="Add User">
</form>


<?php require base_path('views/partials/footer.php') ?>