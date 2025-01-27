<?php


class Validador
{    
    public static function validarNome($nome) {
        if(!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/u', $nome)){

            return true;
        }else{
            return false;
        }
    }

    public static function validarEmail($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

            return true;
        }else{
            return false;
        }
    }

    public static function gerarSenha($senha) {

        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public static function verificarSenha($senha, $hashSenha): bool {

        return password_verify($senha, $hashSenha);
    }
        
        
    
}