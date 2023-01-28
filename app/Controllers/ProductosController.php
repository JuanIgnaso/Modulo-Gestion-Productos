<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

declare(strict_types = 1);
namespace Com\Daw2\Controllers;

class ProductosController extends \Com\Daw2\Core\BaseController{
    
    function showAll(){
        $data=[];
        $data['titulo'] = 'Lista Productos';
        $data['seccion'] = '/productos';
        $data['input'] = filter_Var_Array($_GET,FILTER_SANITIZE_SPECIAL_CHARS);
        $modelProv = new \Com\Daw2\Models\ProveedorModel();
        $modelP = new \Com\Daw2\Models\ProductosModel();
        $modelC = new \Com\Daw2\Models\CategoriaModel();
       /* $data['productos'] = $modelP->mostrarConsulta($_GET,$_ENV['table.rowsPerPage']);*/
        $data['proveedores'] = $modelProv->getAll();
        $data['categorias'] = $modelC->getAll();
        $data['productos_totales'] = $modelP->showAll();
        
        $copiaGET = $_GET;
        unset($copiaGET['order']);
        unset($copiaGET['page']);
        if(count($copiaGET) > 0){
            $data['queryString'] = "&".http_build_query($copiaGET);
        }else{
          $data['queryString'] = "";  
        }
        
        $getOrder = $_GET;
        unset($getOrder['page']);
        if(count($getOrder) > 0){
            $data['queryPage'] = '&'.http_build_query($getOrder);
        }
        else{
            $data['queryPage'] = '';
        }
        
        $data['paginaActual'] = (isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT) && $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
        
        $numRegistros = $modelP->count($_GET);
         $paginas = floor(($numRegistros / (int)$_ENV['table.rowsPerPage']));
        if($numRegistros % (int)$_ENV['table.rowsPerPage'] != 0){
            $paginas++;
        }
        $data['numPaginas'] = $paginas;
        //var_dump($modelo->count($_GET)); die();
        $data['productos'] = $modelP->mostrarConsulta($_GET,(int)$_ENV['table.rowsPerPage']);

        
        $this->view->showViews(array('templates/header.view.php','Productos.view.php','templates/footer.view.php'),$data);
    }
    
    function mostrarAdd(){
        $data=[];
        $data['titulo'] = 'Alta Productos';
        $data['seccion'] = '/addProducto';
        $modelProv = new \Com\Daw2\Models\ProveedorModel();
        $modelC = new \Com\Daw2\Models\CategoriaModel();
        $data['proveedores'] = $modelProv->getAll();
        $data['categorias'] = $modelC->getAll();
        
        $this->view->showViews(array('templates/header.view.php','AltaProducto.view','templates/footer.view.php'),$data);
        
    }
}