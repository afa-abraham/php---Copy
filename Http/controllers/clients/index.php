<?php
require base_path('db/config.php');

$results = $conn->query("SELECT id, fname,lname from clients");


view('clients/index.view.php',[
    'results' => $results
]);