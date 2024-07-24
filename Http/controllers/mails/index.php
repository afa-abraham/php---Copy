<?php


use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$users = $db->query('select * from users')->get();



view("mails/index.view.php", [
    'heading' => 'View Messages',
    'users' => $users
]);