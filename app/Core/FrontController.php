<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController{
    
    static function main(){
        Route::add('/', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\InicioController();
                    $controlador->index();
                }
                , 'get');                
                
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
            
                /*
                  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 
                 */
                
                
                 Route::add('/productos', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\ProductosController();
                    $controlador->showAll();
                }
                , 'get');       

                
                
        
        Route::methodNotAllowed(
            function(){
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error405();
            }
        );
        Route::run();
    }
}

