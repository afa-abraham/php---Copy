<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


// find the corresponding note
$women = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();


$db->query('update users set 
    first_name = :first_name,
    last_name =:last_name,
    middle_name = :middle_name,
    age = :age,
    birthdate = :birthdate,
    mobile_number = :mobile_number,
    marital_status = :marital_status,
    fb_link = :fb_link,
    where id = :id', [
    'id' => $_POST['id'],
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'middle_name' => $_POST['middle_name'],
    'age' => $_POST['age'],
    'birthdate' => $_POST['birthdate'],
    'mobile_number' => $_POST['mobile_number'],
    'marital_status' => $_POST['marital_status'],
    'fb_link' => $_POST['fb_link']
]);

// redirect the user
header('location: /womens');
die();