<?php
require base_path('db/config.php');


    // Function to get thread ID or create a new one
    function getThreadId($conn, $sender_id, $receiver_id) {
        $thread_id = null;

        // Check if a thread already exists between the sender and receiver
        $query = "SELECT thread_id FROM mails WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
        $stmt->execute();
        $stmt->bind_result($thread_id);
        $stmt->fetch();
        $stmt->close();

        // If a thread exists, return its ID
        if ($thread_id !== null) {
            return $thread_id;
        } else {
            // If no thread exists, create a new thread ID
            $query = "SELECT IFNULL(MAX(thread_id), 0) + 1 AS new_thread_id FROM mails";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $new_thread_id = $row['new_thread_id'];
            return $new_thread_id;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sender_id = $_SESSION['user_id'];
        $receiver_name = $_POST['receiver_name'];
        $body = $_POST['body'];

        // Split the receiver name into first and last names
        list($fname, $lname) = explode(' ', $receiver_name, 2);

        // Retrieve the receiver's ID from the clients table
        $query = "SELECT id FROM clients WHERE fname = ? AND lname = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $fname, $lname);
        $stmt->execute();
        $stmt->bind_result($receiver_id);
        $stmt->fetch();
        $stmt->close();

        if (!$receiver_id) {
            $message = "Receiver not found.";
        } else {
            // Get the appropriate thread ID
            $thread_id = getThreadId($conn, $sender_id, $receiver_id);

            // Insert the email into the mails table
            $query = "INSERT INTO mails (sender_id, receiver_id, body, thread_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iisi", $sender_id, $receiver_id, $body, $thread_id);

            if ($stmt->execute()) {
                $message = "Email sent successfully!";
                $icon = "success";
            } else {
                $message = "Error: " . $stmt->error;
                $icon = "error";
            }

            $stmt->close();
        }
        $conn->close();

        // Display SweetAlert message
        echo "<script>
            Swal.fire({
                title: '$message',
                icon: '$icon'
            });
        </script>";
    }
    ?>
