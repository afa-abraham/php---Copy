<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the method is PATCH
    if (isset($_POST['_method']) && $_POST['_method'] === 'PATCH') {
        // Connect to MySQL
        $mysqli = new mysqli("localhost", "root", "", "m5");

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Get user ID from form
        $user_id = intval($_POST['id']);
        
        // Update role_id to 2
        $stmt = $mysqli->prepare("UPDATE users SET role_id = ? WHERE id = ?");
        $new_role_id = 2;
        $stmt->bind_param("ii", $new_role_id, $user_id);

        if ($stmt->execute()) {
            echo "Role updated successfully.";
        } else {
            echo "Error updating role: " . $mysqli->error;
        }

        $stmt->close();
        $mysqli->close();
    }
}
?>
