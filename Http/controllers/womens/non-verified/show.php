<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);



$women = $db->query('select * from users where id = :id' , [
    'id' => $_GET['id'],
    
])->findOrFail();


view("womens/non-verified/show.view.php", [
    'heading' => 'Note',
    'women' => $women
]);
