<?php
require base_path('views/partials/head.php') ;
require base_path('views/partials/sidebar.php'); 
require base_path('views/partials/nav.php') ; ?>

<div class="container mt-3">
    <h3>Read Messages</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>FROM</th>
                <th>Message</th>
                <th>To</th>
            </tr>
        </thead>
        <tbody>
            <?php
    // Check if any rows are returned
if ($result->num_rows > 0) {
    // Fetch and display the results
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo "<td><a href='/admin/inbox?id=" . $row["id"]. "'>"  . htmlspecialchars($row['sender_name']) . "</a></td>";
        echo "<td><a href='/admin/inbox?id=" . $row["id"]. "'>" . htmlspecialchars($row['body']) . "</a></td>";
        echo "<td><a href='/admin/inbox?id=" . $row["id"]. "'>" . htmlspecialchars($row['receiver_name']) . "</a></td>";
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4">No unread messages found.</td></tr>';
}
    // Free result set
 $result->free(); ?>
        </tbody>
    </table>
</div>



 <?php require base_path('views/partials/footer.php') ?>
