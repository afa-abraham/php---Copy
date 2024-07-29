<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['cpassword'];
$entered_password = $_POST['password'];


$errors = [];
if (!Validator::email($email)) {
   $errors['status'] = 'Please provide a valid email address.';
}


if (!Validator::string($password, 7, 255)) {
    $errors['status'] = 'Please provide a password of at least seven characters.';
}

if(!Validator::confirmPassword($password, $confirm_password)) {
    $errors['status'] = "Password doesn't match.";
}




if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}


$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

$ran_id = rand(time(), 100000000);

if ($user) {
    header('location: /');
    exit();
} else {
    $db->query('INSERT INTO users(email, password, unique_id) VALUES(:email, :password,:unique_id)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'unique_id' => $ran_id
    ]);

    (new Authenticator)->login(['email' => $email]);
    header('location: /');
    exit();
    
}