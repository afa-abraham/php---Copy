<?php

function checkRole($required_role)
    {
        if (!isset($_SESSION['role_id'])) {
            return false;
        }

        global $db;

        $role_name = $db->query("SELECT role_name FROM roles WHERE id = ?",[
            'role_id' => $_SESSION['role_id']
        ])->findOrFail();
    
        return $role_name === $required_role;

    }



