<?php
require base_path('db/config.php');

$result = $conn->query('SELECT id, full_name, email from users where role_id = 2');


view('womens/account.view.php',[
    'result' => $result
]);

