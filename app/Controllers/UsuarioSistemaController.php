<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

namespace Com\Daw2\Controllers;

class UsuarioSistemaController extends \Com\Daw2\Core\BaseController{
    
    //Declaracion de constantes con las id de los distintos roles
    private const ROL_ADMINISTRADOR = 1;
    private const ENCARGADO_PRODUCTOS = 4;
    private const ENCARGADO_PROVEEDORES = 5;
    private const ENCARGADO_CATEGORIAS = 6;
    private const AUDITOR = 7;
    
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
        //Creas el objeto llamando al modelo.
        $usuario = $model->login($_POST['email'],$_POST['password']);
        $_vars = [];
        
        if(is_null($usuario)){
            $_vars['loginError'] = 'Datos de acceso Incorrectos';
        }else{
            //En caso de que el login sea exitoso
            $_SESSION['user'] = $usuario;
            $_SESSION['permisos'] = $this->getPermisos($usuario->getIDRol());
            header('Location: /');
        }
     $this->view->show('login.view.php',$_vars);

    }
    
    //Función para mostrar los usuarios del sistema
    function mostrarUsuariosSistema(){
       $model = new \Com\Daw2\Models\UsuarioSistemaModel();
        $data = [];
        $data['usuarios'] = $model->getAll();
        $data['input'] = filter_var_array($_GET,FILTER_SANITIZE_SPECIAL_CHARS);
        $data['titulo'] = 'Lista de Usuarios De Sistema';
        $data['seccion'] = '/usuarios_sistema';
        $this->view->showViews(array('templates/header.view.php','UsuariosSistemaView.php','templates/footer.view.php'),$data);
    }
    
    //Declaración de permisos de usuario
    private function getPermisos(int $idRol): array{
        //Creamos el array vacío
        $permisos = array(
        'categorias' => '',
        'proveedores' => '',
        'productos' => ''    
        );
        //En función del rol del usuario se rellenan con los permisos 
        //de cada uno
        if(self::ROL_ADMINISTRADOR == $idRol){
            $permisos['categorias'] = 'rwd';
            $permisos['proveedores'] = 'rwd';
            $permisos['productos'] = 'rwd';            
        }
        else if(self::ENCARGADO_PRODUCTOS == $idRol){
            $permisos['productos'] = 'rwd';            
        }
        else if(self::ENCARGADO_PROVEEDORES == $idRol){
         $permisos['proveedores'] = 'rwd';
        }
        else if(self::ENCARGADO_CATEGORIAS == $idRol){
            $permisos['categorias'] = 'rwd';
        }
        else if(self::AUDITOR == $idRol){
            $permisos['categorias'] = 'r';
            $permisos['proveedores'] = 'r';
            $permisos['productos'] = 'r';
        }
        
        return $permisos;
    }
    
    function mostrarAdd(){
        $model = new \Com\Daw2\Models\RolModel();
        $data = [];
        $data['roles'] = $model->getAll();
        $data['input'] = filter_var_array($_GET,FILTER_SANITIZE_SPECIAL_CHARS);
        $data['titulo'] = 'Dar de alta Usuario De Sistema';
        $data['seccion'] = '/usuarios_sistema/add';
       $this->view->showViews(array('templates/header.view.php','UsuarioSistemaAdd.view.php','templates/footer.view.php'),$data);  
    }
    
    function addUsuarioSistema(){
        $data=[];
        $model = new \Com\Daw2\Models\RolModel();
        $data['roles'] = $model->getAll();
        //$data['input'] = filter_var_array($_GET,FILTER_SANITIZE_SPECIAL_CHARS);
        $data['titulo'] = 'Dar de alta Usuario De Sistema';
        $data['seccion'] = '/usuarios_sistema/add';
        $data['errrores'] = $this->checkAdd($_POST);
        if(count($data['errores']) == 0){
            $modelUsuario = new \Com\Daw2\Models\UsuarioSistemaModel();
            $result = $modelUsuario->addUsuario($_POST);
            if($result){
                header('Location: /usuarios_sistema');
            }else{
                $data['error_add'] = 'Ha habido un error al intentar añadir el usuario';
            }
           
        }else{
         $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
         $this->view->showViews(array('templates/header.view.php','UsuarioSistemaAdd.view.php','templates/footer.view.php'),$data);  

        }

    }
    
    function checkAdd(array $post): array{
        $model = new \Com\Daw2\Models\UsuarioSistemaModel();
        $errores = [];
        if(empty($post['email'])){
            $errores['email'] = 'Este campo es obligatorio';
        }else if(!filter_var($post['email'],FILTER_VALIDATE_EMAIL)){
            $errores['email'] = 'El correo introducido no es válido';
        }else if($model->existeUsuario($post['email'])){
            $errores['email'] = 'El correo que deseas registrar ya está en uso';
        }
        if(empty($post['nombre'])){
            $errores['nombre'] = 'Este campo es obligatorio';
        }
        if(empty($post['pass'])){
            $errores['pass'] = 'Este campo es obligatorio';
        }else if(strlen($post['pass']) < 5){
            $errores['pass'] = 'La contraseña debe de ser de al menos 5 caracteres de largo';
        }
        if(empty($post['roles'][0])){
            $errores['roles'] = 'El usuario debe de tener asignado al menos un rol';
        }
        return $errores;
    }
}