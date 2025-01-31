<?php


class Sessao
{
    public static function mensagemAlerta($nome, $texto = null, $classe = null)
{
    if (!empty($nome)) {
        // Se texto for passado, define a mensagem na sessão
        if (!empty($texto) && empty($_SESSION[$nome])) {
            if(!empty($_SESSION[$nome])):
                unset($_SESSION[$nome]);
                endif;

            $_SESSION[$nome] = $texto;
            $_SESSION[$nome.'classe'] = $classe; 
            
        }elseif (!empty($_SESSION[$nome]) && empty($texto)){

            $classe = !empty($_SESSION[$nome.'classe']) ? $_SESSION[$nome.'classe'] : 'success';
            echo '<div class=" text-center alert alert-' .$classe. '" role="alert">'. $_SESSION[$nome] .'</div>';
            unset($_SESSION[$nome], $_SESSION[$nome . 'classe']);

            }
        }
    }
}
