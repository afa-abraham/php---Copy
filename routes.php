<?php

$router->get('/', 'index.php');
$router->get('/admin', 'admin.php');
$router->get('/verified-user', 'verified-user.php');

$router->get('/mails', 'mails/index.php')->only('auth');
$router->get('/mail', 'mails/show.php');
$router->delete('/mail', 'mails/destroy.php');
$router->get('/mail/edit', 'mails/edit.php');
$router->patch('/mail', 'mails/update.php');
$router->get('/mails/create', 'mails/create.php');
$router->post('/mails', 'mails/store.php');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');



$router->get('/verify-account','verify-account/create.php')->only('auth');
$router->post('/verify-account','verify-account/store.php')->only('auth');
