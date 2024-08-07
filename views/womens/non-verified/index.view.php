<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<h3 class="mt-3 ms-3">Non-Verified Account List</h3>
<div class="container mt-3">
<table class="table table-striped table-bordered mx-3">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    <?php
if ($results->num_rows > 0) {
    // Output data for each row
    while ($row = $results->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href='nonverified/women?id=" . $row["id"] . "'>" . $row["id"] . "</a></td>";
        echo "<td><a href='nonverified/women?id=" . $row["id"] . "'>" . $row["full_name"] . "</a></td>";
        echo "<td><a href='nonverified/women?id=" . $row["id"] . "'>" . $row["email"] . "</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No users found</td></tr>";
}
    ?>
</table>
</div>

<?php $results->close(); ?>







<?php require base_path('views/partials/footer.php') ?>