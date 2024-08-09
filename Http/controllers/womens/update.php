<?php
require base_path('db/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the method is PATCH
    if (isset($_POST['_method']) && $_POST['_method'] === 'PATCH') {
       
        // Get user ID from form
        $user_id = intval($_POST['id']);
        
        // Update role_id to 2
        $stmt = $conn->prepare("UPDATE users SET role_id = ? WHERE id = ?");
        $new_role_id = 2;
        $stmt->bind_param("ii", $new_role_id, $user_id);

        if ($stmt->execute()) {
            echo "Role updated successfully.";
        } else {
            echo "Error updating role: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
