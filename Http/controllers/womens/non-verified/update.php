<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


// find the corresponding note
$women = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();


$db->query('update users set 
    fname = :fname,
    lname =:lname,
    middle_name = :middle_name,
    age = :age,
    birthdate = :birthdate,
    mobile_number = :mobile_number,
    marital_status = :marital_status,
    fb_link = :fb_link,
    where id = :id', [
    'id' => $_POST['id'],
    'fname' => $_POST['fname'],
    'lname' => $_POST['lname'],
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