<?php
require base_path('views/partials/head.php') ;
require base_path('views/partials/sidebar.php'); 
require base_path('views/partials/nav.php') ; 


// Check if the query was successful
if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    // Fetch and display the latest messages
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . "<br>";
            echo "Body: " . $row["body"] . "<br>";
            echo "Created At: " . $row["created_at"] . "<br>";
            echo "User Name: " . $row["sender_id"] . "<br><br>";
        }
    } else {
        echo "No messages found.";
    }
}




 require base_path('views/partials/footer.php') ?>