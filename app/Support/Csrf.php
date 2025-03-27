<?php

class Csrf
{

    public static function getToken()
    {

        if (isset($_SESSION['token'])) {
            unset($_SESSION['token']);
        }

        $_SESSION['token'] = bin2hex(random_bytes(32));

        return "<input type='hidden' name='token' value='" . $_SESSION['token'] . "'>";
    }

    public static function validarToken($token)
    {
        if (!isset($_SESSION['token'])) {

            header(URL . "usuarios/erro-403");
            // Redireciona para a página de erro 403
            exit;
        }

        if ($token !== $_SESSION['token'] || $_SERVER['REQUEST_METHOD'] !== 'POST') {

            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            // Definir o status HTTP 403 (Forbidden)
            header("HTTP/1.1 403 Forbidden");

            // Opcionalmente, você pode redirecionar para outra página de erro personalizada
            // header("Location: /erro-403.php");  // Caso você queira redirecionar para outra página

            // Exibir conteúdo da página 403
            header("Location: usuarios/error-403.php");
            exit;
        }

        unset($_SESSION['token']);
        return true;
    }
}
