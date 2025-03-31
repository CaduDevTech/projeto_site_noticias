<?php

class Csrf
{

    public static function getToken()
    {

        if (isset($_SESSION['token'])) {
            unset($_SESSION['token']);
        }

        $_SESSION['token'] = bin2hex(random_bytes(32));

        return "<input type='hidden' name='token' value='" . $_SESSION['token']. "'>";
    }

    public static function validarToken($token)
    {

        switch (true) {
            case $token !== $_SESSION['token'] || $_SERVER['REQUEST_METHOD'] !== 'POST':
                unset($_SESSION['token']);
                $_SESSION['token'] = bin2hex(random_bytes(32));

                $usuario = new Usuarios();
                $usuario->sair("erros/erro-403.php");
                exit();

            case $token == $_SESSION['token'] && $_SERVER['REQUEST_METHOD'] == 'POST':
                unset($_SESSION['token']);
                return true;

            default: die('Erro ao validar token');
        }
 

    }
}
