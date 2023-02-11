<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

namespace Com\Daw2\Controllers;

class UsuarioSistemaController extends \Com\Daw2\Core\BaseController{
    
    /*
     * FUNCIONES DEL CONTROLADOR NECESARIAS PARA PODER INICIAR SESIÓN
     * 1-Mostrar el login
     * 2-funcion para loguear
     */
    
    public function login(){
        $this->view->show('login.view.php');
    }
    
    public function loginUser(){
        $model = new \Com\Daw2\Models\UsuarioSistemaModel();
        
    }
    
}