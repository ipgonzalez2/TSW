<?php

//Función que valida si un usuario está autenticado


function estaAutenticado(){
    if(!isset($_SESSION['email'])){
        return false;
    }
    return true;

}

?>