<?php
require base_path('db/config.php');

$results = $conn->query('SELECT id, full_name, email from users where role_id = 3');


view('womens/non-verified.view.php',[
    'results' => $results
]);

