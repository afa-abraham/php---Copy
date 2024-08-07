<?php
require base_path('views/partials/head.php') ;
require base_path('views/partials/sidebar.php'); 
require base_path('views/partials/nav.php') ; ?>

<div class="container mt-3">
    <h3>Answered Messages</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>TO</th>
                <th>Message</th>
                <th>Created at</th>
                <th>FROM</th>
            </tr>
        </thead>
        <tbody>
            <?php
// Check if the query was successful
if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    // Fetch and display the latest messages
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo "<td><a href='/admin/inbox?id=" .$row['id']. "'>" . htmlspecialchars($row['receiver_name']) . "</a></td>";
            echo "<td><a href='/admin/inbox?id=" .$row['id']. "'>" . htmlspecialchars($row['body']) . "</a></td>";
            echo "<td><a href='/admin/inbox?id=" .$row['id']. "'>" . htmlspecialchars($row['created_at']) . "</a></td>";
            echo "<td><a href='/admin/inbox?id=" .$row['id']. "'>" . htmlspecialchars($row['receiver_id']) . "</a></td>";
        }
    } else {
        echo "No messages found.";
    }
}




 require base_path('views/partials/footer.php') ?>