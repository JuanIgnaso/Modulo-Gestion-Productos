<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

namespace Com\Daw2\Controllers;

class SessionController extends \Com\Daw2\Core\BaseController{
    
    
    
    /**
     * Método para desloguear el usuario
     */
    function borrarSesion(){
        if(isset($_SESSION['user'])){
            session_destroy();
        }
        header('Location: /');
    }
}
