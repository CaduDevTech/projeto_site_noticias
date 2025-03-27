<?php
class CriaCsrf
{
    public static function getToken() {

       return Csrf::getToken(); 
    }
}
