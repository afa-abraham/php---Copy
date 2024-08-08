<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<h3>Profile Info</h3>
<ul>
    <li>ID: <?= htmlspecialchars($client['id']) ?></li>
    <li>First Name: <?= htmlspecialchars($client['fname']) ?></li>
    <li>Last Name: <?= htmlspecialchars($client['lname']) ?></li>
    <li>Age: <?= htmlspecialchars($client['age']) ?></li>
    <li>Location: <?= htmlspecialchars($client['location']) ?></li>
    <li>Height: <?= htmlspecialchars(stripslashes($client['height'])) ?></li>
    <li>Weight: <?= htmlspecialchars($client['weight']) ?></li>
    <li>Interested: <?= htmlspecialchars($client['weight']) ?></li>
    <li>Body Type: <?= htmlspecialchars($client['body_type']) ?></li>
    <li>Hair Color: <?= htmlspecialchars($client['hair_color']) ?></li>
    <li>Eyes Color: <?= htmlspecialchars($client['eyes_color']) ?></li>
    <li>Ethnicity: <?= htmlspecialchars($client['ethnicity']) ?></li>
    <li>Marital Status: <?= htmlspecialchars($client['marital_status']) ?></li>
    <li>Smoking: <?= htmlspecialchars($client['smoking']) ?></li>
    <li>Drinking: <?= htmlspecialchars($client['drinking']) ?></li>
    <li>Religion: <?= htmlspecialchars($client['religion']) ?></li>
    <li>Education: <?= htmlspecialchars(stripslashes($client['education'])) ?></li>
    <li>Children: <?= htmlspecialchars($client['children']) ?></li>
    <li>No. of children: <?= htmlspecialchars($client['no_of_children']) ?></li>
    <li>Employment: <?= htmlspecialchars($client['employment']) ?></li>
    <li>Description: <?= htmlspecialchars(stripslashes($client['description'])) ?></li>
    <li>Ideal Match: <?= htmlspecialchars(stripslashes($client['idealMatch'])) ?></li>
    <li>Additional Comments: <?= htmlspecialchars($client['additional_comments']) ?></li>

</ul>



<?php require base_path('views/partials/footer.php') ?>