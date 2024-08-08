<?php 

use Core\App;
use Core\Database;


$db = App::resolve(Database::class);


$db->query('UPDATE users SET fname = :fname, middle_name = :middle_name, lname= :lname, age = :age, birthdate = :birthdate, marital_status = :marital_status, mobile_number= :mobile_number, fb_link=:fb_link WHERE id=:id ',[
    'fname' => $_POST['fname'],
    'middle_name' => $_POST['middle_name'],
    'lname' => $_POST['lname'],
    'age' => $_POST['age'],
    'birthdate' => $_POST['birthdate'],
    'marital_status' => $_POST['marital_status'],
    'mobile_number' => $_POST['mobile_number'],
    'fb_link' => $_POST['fb_link'],
    'id' => $_POST['id']
]);


redirect('/womens/nonverified');

