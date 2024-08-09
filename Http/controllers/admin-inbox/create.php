<?php 
require base_path('db/config.php');

if (isset($_GET['query'])) {
    $search = $_GET['query'];
    $query = "SELECT CONCAT(fname, ' ', lname) AS fullname FROM users WHERE CONCAT(fname, ' ', lname) LIKE ? LIMIT 10";
    $stmt = $conn->prepare($query);
    $search_param = "%".$search."%";
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['fullname'];
    }

    $stmt->close();
    echo json_encode($suggestions);
}


view('admin-inbox/create.view.php');

$conn->close();




