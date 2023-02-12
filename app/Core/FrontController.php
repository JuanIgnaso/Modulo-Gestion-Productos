<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController{
    
    static function main(){
        
        session_start();
       
        
        
        
                 /*******METODOS EN EL FRONT PARA PODER LOGUEARSE******/       
               //Para que en caso de no tener sesion iniciada te redirija al login
 
      
           
           
        Route::add('/login',
           function(){
                  $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                  $controlador->login();
                }
            ,'get');   
            
            
        //Loguear usuario         
        Route::add('/login',
                function(){
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->loginUser();
                }
            ,'post');  
            


        
        
        Route::add('/', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\InicioController();
                    $controlador->index();
                }
                , 'get');  
                
             

            
                         
        Route::add('/logout',
                function(){
                    $controlador = new \Com\Daw2\Controllers\SessionController();
                    $controlador->borrarSesion();
                }
            ,'get');      
            
                
            
            
        /***************************************************/
                
        Route::pathNotFound(
            function(){
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error404();
            }
        );

        Route::add('/csv/historico', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\CSVController();
                    $controlador->poblacionPontevedra();
                }
                , 'get');
        
        Route::add('/csv/grupos-edad', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\CSVController();
                    $controlador->poblacionGruposEdad();
                }
                , 'get');
        
        Route::add('/csv/totales-2020', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\CSVController();
                    $controlador->poblacion2020Totales();
                }
                , 'get');
                
        Route::add('/csv/new-2020', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\CSVController();
                    $controlador->new2020Form();
                }
                , 'get');
        
        Route::add('/csv/new-2020', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\CSVController();
                    $controlador->new2020FormProcess();
                }
                , 'post');
                      
                  Route::add('/usuarios', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarTodos();
                }
                , 'get'); 
                
                Route::add('/usuarios/ordenados', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarPorSalario();
                }
                , 'get'); 
                
                  Route::add('/usuarios/Standard', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarStandard();
                }
                , 'get'); 
                
            /***********************PRODUCTOS******************************/    

    if(isset($_SESSION['user']) && preg_match('/rwd/',$_SESSION['permisos']['productos'])){
          Route::add('/productos', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\ProductosController();
                    $controlador->showAll();
                }
                , 'get'); 
                
                
                //Añadir Productos
                                
                 Route::add('/addProducto', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\ProductosController();
                    $controlador->mostrarAdd();
                }
                , 'get'); 
                
                Route::add('/addProducto', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\ProductosController();
                    $controlador->add();
                }
                , 'post'); 
                
                //Borrar Producto /cantDelete
                
                
                
                Route::add('/productos/delete/([A-Za-z0-9]+)',
                function ($codigo) {
                    $controlador = new \Com\Daw2\Controllers\ProductosController();
                    $controlador->delete($codigo);
                }
                , 'get');
                
                
                Route::add('/cantDelete',
                function ($mensaje) {
                    $controlador = new \Com\Daw2\Controllers\ProductosController();
                    $controlador->cant_delete($mensaje);
                }
                , 'get');
                
                //Modificar Producto
                //Se tiene que pasar una variable en este caso el codigo
                 Route::add('/producto/edit/([A-Za-z0-9]+)',
                function ($codigo) {
                    $controlador = new \Com\Daw2\Controllers\ProductosController();
                    $controlador->mostrarEdit($codigo);
                }
                , 'get');
                
                Route::add('/producto/edit/([A-Za-z0-9]+)',
                function ($codigo) {
                    $controlador = new \Com\Daw2\Controllers\ProductosController();
                    $controlador->edit($codigo);
                }
                , 'post');
    }            
                
               
         
        /****************************PROVEEDORES********************************/        
             if(isset($_SESSION['user']) && preg_match('/rwd/',$_SESSION['permisos']['proveedores'])){
                
                 Route::add('/proveedores',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProveedorController();
                    $controlador->showAll();
                }
                , 'get');  
             }
       

                
                
        /********************************CATEGORIAS**********************************/        
  if(isset($_SESSION['user']) && preg_match('/rwd/',$_SESSION['permisos']['categorias'])){
                      
            Route::add('/categorias',
                    function(){
                $controlador = new \Com\Daw2\Controllers\CategoriaController();
                $controlador->showAll();
                    }
                ,'get'); 
  }
               
   /******************USUARIOS****************************/
  
              Route::add('/usuarios_sistema',
                    function(){
                $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                $controlador->mostrarUsuariosSistema();
                    }
                ,'get'); 
                
                         Route::add('/usuarios_sistema/add',
                    function(){
                $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                $controlador->mostrarAdd();
                    }
                ,'get');      
  
                
              Route::add('/usuarios_sistema/add',
                    function(){
                $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                $controlador->addUsuarioSistema();
                    }
                ,'post'); 
        
        Route::methodNotAllowed(
            function(){
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error405();
            }
        );
       
        Route::run();
    }
}

