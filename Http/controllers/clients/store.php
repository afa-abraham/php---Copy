<?php

require base_path('db/config.php');

$sql = "CREATE TABLE IF NOT EXISTS clients (
    id INT(6) UNSIGNED NOT NULL PRIMARY KEY,
    fname VARCHAR(50) NULL,
    lname VARCHAR(50) NULL,
    age INT(11) NULL,
    location VARCHAR(50) NULL,
    height VARCHAR(20) NULL,
    weight VARCHAR(20) NULL,
    interested VARCHAR(50) NULL,
    body_type VARCHAR(20) NULL,
    hair_color VARCHAR(20) NULL,
    eyes_color VARCHAR(20) NULL,
    ethnicity VARCHAR(50) NULL,
    marital_status VARCHAR(50) NULL,
    smoking VARCHAR(50) NULL,
    drinking VARCHAR(50) NULL,
    religion VARCHAR(50) NULL,
    education VARCHAR(100) NULL,
    children VARCHAR(50) NULL,
    no_of_children INT(11) NULL,
    employment VARCHAR(50) NULL,
    description TEXT NULL,
    idealMatch TEXT NULL,
    additional_comments TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Table 'clients' is ready.";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Collect and sanitize input data
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $age = $conn->real_escape_string($_POST['age']);
    $location = $conn->real_escape_string($_POST['location']);
    $height = $conn->real_escape_string($_POST['height']);
    $weight = $conn->real_escape_string($_POST['weight']);
    $interested = $conn->real_escape_string($_POST['interested']);
    $body_type = $conn->real_escape_string($_POST['body_type']);
    $hair_color = $conn->real_escape_string($_POST['hair_color']);
    $eyes_color = $conn->real_escape_string($_POST['eyes_color']);
    $ethnicity = $conn->real_escape_string($_POST['ethnicity']);
    $marital_status = $conn->real_escape_string($_POST['marital_status']);
    $smoking = $conn->real_escape_string($_POST['smoking']);
    $drinking = $conn->real_escape_string($_POST['drinking']);
    $religion = $conn->real_escape_string($_POST['religion']);
    $education = $conn->real_escape_string($_POST['education']);
    $children = $conn->real_escape_string($_POST['children']);
    $no_of_children = $conn->real_escape_string($_POST['no_of_children']);
    $employment = $conn->real_escape_string($_POST['employment']);
    $description = $conn->real_escape_string($_POST['description']);
    $idealMatch = $conn->real_escape_string($_POST['idealMatch']);
    $additional_comments = $conn->real_escape_string($_POST['additional_comments']);

    // Generate a unique 6-digit ID
    $id = mt_rand(100000, 999999);

    // Check if ID already exists in clients table
    $idCheckQuery = "SELECT id FROM clients WHERE id = '$id'";
    $result = $conn->query($idCheckQuery);

    // If ID exists, generate a new one
    while ($result->num_rows > 0) {
        $id = mt_rand(100000, 999999);
        $result = $conn->query($idCheckQuery);
    }

    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO clients (id, fname, lname, age, location, height, weight, interested, body_type, hair_color, eyes_color, ethnicity, marital_status, smoking, drinking, religion, education, children, no_of_children, employment, description, idealMatch, additional_comments) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ississssssssssssssissss", $id, $fname, $lname, $age, $location, $height, $weight, $interested, $body_type, $hair_color, $eyes_color, $ethnicity, $marital_status, $smoking, $drinking, $religion, $education, $children, $no_of_children, $employment, $description, $idealMatch, $additional_comments);

    $success = false;
    // Execute the statement
    if ($stmt->execute()) {
        // Close the first statement
        $stmt->close();
        
        $roleId = 4;
        // Prepare and bind the second statement for the users table
        $stmt = $conn->prepare("INSERT INTO users (id, fname, lname,role_id) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("issi", $id, $fname, $lname, $roleId);

        // Execute the statement
        if ($stmt->execute()) {
            $success = true ;
        } else {
            echo "Error inserting into users table: " . $stmt->error;
        }

        // Close the second statement
        $stmt->close();
    } else {
        echo "Error inserting into clients table: " . $stmt->error;
    }
}

// Close the connection
$conn->close();

 // Redirect to another page if successful
 if ($success) {
    echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'New record created successfully',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
          </script>";
}

redirect('/clients');


