<?php

$router->get('/', 'index.php');
$router->get('/admin', 'admin.php');
$router->get('/verified-user', 'verified-user.php');

$router->get('/mails/inbox', 'mails/inbox.php');
$router->get('/mails/create', 'mails/send_mail.php');
$router->post('/mails/store', 'mails/send_mail.php');
$router->get('/mails/drafts', 'mails/drafts.php');
$router->get('/mails/sent', 'mails/sent.php');
$router->patch('/mail/edit', 'mails/edit_draft.php');
$router->get('/mails/reply', 'mails/view_message.php');

$router->get('/womens', 'womens/account.php');
$router->get('/womens/nonverified', 'womens/non-verified/index.php');
$router->get('/womens/nonverified/women', 'womens/non-verified/show.php');
$router->get('/womens/nonverified/update', 'womens/non-verified/edit.php');
$router->patch('/womens/nonverified/store', 'womens/non-verified/store.php');
$router->get('/womens/create', 'womens/create.php');
$router->post('/womens/store', 'womens/store.php');
$router->patch('/womens/update', 'womens/update.php');

$router->get('/clients', 'clients/index.php');
$router->get('/clients/create', 'clients/create.php');
$router->post('/clients/store', 'clients/store.php');


$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');



$router->get('/verify-account', 'verify-account/create.php')->only('auth');
$router->post('/verify-account', 'verify-account/store.php')->only('auth');
