<?php

class Url {
    

public static function redireicionar($url) {
    header("Location:".URL.DIRECTORY_SEPARATOR. $url);
    }
}