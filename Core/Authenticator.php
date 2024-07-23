<?php

namespace Core;

class Authenticator

{


    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)
            ->query('select * from users where email = :email', [
            'email' => $email,
        ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email,
                ]);

                return [
                    'authenticated' => true,
                    'role_id' => $user['role_id']
                ];
            }
        }

        return [
            'authenticated' => false,
            'role_id' => null
        ];
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);

    }

    public function logout()
    {
        Session::destroy();
    }
}

