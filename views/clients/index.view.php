<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<a type="btn btn-primary" href="/clients/create" class="my-2 py-2 mx-auto" style="background: blue;color:white; width:150px;">&nbsp;Add Client Details</a>
<div class="container mt-3">
    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
        </tr>
        <?php
        if ($results->num_rows > 0) {
            // Output data for each row
            while ($row = $results->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='/client?id=" . $row["id"]. "'>" . htmlspecialchars($row["id"]) . "</a></td>";
                echo "<td><a href='/client?id=" . $row["id"]. "'>" . htmlspecialchars($row['fname']) . ' ' . htmlspecialchars($row['lname']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }
        ?>
    </table>
</div>



  <?php require base_path('views/partials/footer.php') ?>