<?php

use Core\App;
use Core\Database;


$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email limit 1', [
    'email' => $_SESSION['user']['email']
])->findOrFail();

view("verify-account/create.view.php",[
    'errors' => [],
    'user' => $user
]);

