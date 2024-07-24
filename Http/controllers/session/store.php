<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

use Core\App;
use Core\Database;


$db = App::resolve(Database::class);

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
]);


$result = (new Authenticator)->attempt(
    $attributes['email'], $attributes['password']
);

if ($result['authenticated']) {
    $signedIn = true;
    $roleId = $result['role_id'];
    // Use $roleId as needed
    echo "User signed in with role ID: " . $roleId;
} else {
    $signedIn = false;
    echo "Authentication failed.";
}

if (!$signedIn) {
    $form->error(
        'email', 'No matching account found for that email address and password.'
    )->throw();
}


if ($roleId == 1) {
    redirect('/admin');
} elseif ($roleId == 2) {
    redirect('/verified-user');
} else {
    redirect('/');
}

