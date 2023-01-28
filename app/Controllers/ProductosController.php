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
        $data['productos'] = $modelP->mostrarConsulta($_GET);
        $data['proveedores'] = $modelProv->getAll();
        $data['categorias'] = $modelC->getAll();
        
        $copiaGET = $_GET;
        unset($copiaGET['order']);
        if(count($copiaGET) > 0){
            $data['queryString'] = "&".http_build_query($copiaGET);
        }else{
          $data['queryString'] = "";  
        }
        
        $this->view->showViews(array('templates/header.view.php','Productos.view.php','templates/footer.view.php'),$data);
    }
}