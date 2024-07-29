<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<h1>Women Account List</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["full_name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No users found</td></tr>";
    }
    ?>
</table>

<?php $result->close(); ?>







<?php require base_path('views/partials/footer.php') ?>