<?php

declare(strict_types = 1);
namespace Com\Daw2\Controllers;

class ProductoController extends \Com\Daw2\Core\BaseController{
    
    function mostrarTodos(){
        $data = [];
        $model = new \Com\Daw2\Models\ProductoModel();
        $categoriaModel = new \Com\Daw2\Models\AuxProductoModel();
        $data['titulo'] = 'Mostrar Productos';
        $data['seccion'] = '/productos';
        $data['categorias'] = $categoriaModel->getAll();
        $data['input'] = filter_var_array($_GET,FILTER_SANITIZE_SPECIAL_CHARS);
        $data['productos'] = $model->filterAll($_GET);
        
//        if(isset($_GET['categoria']) && is_array($_GET['categoria'])){
//            $data['productos'] = $model->filtrarPorCategoria($_GET['categoria']);
//        }else if(isset($_GET['nombre']) && !empty($_GET['nombre'])){
//            $data['productos'] = $model->filtrarPorNombre($_GET['nombre']);
//            //ACE0000343
//        }else if(isset($_GET['codigo']) && !empty($_GET['codigo']) && preg_match('/^ACE0000[0-9]{3}$/',$_GET['codigo'])){
//            $data['productos'] = $model->filtrarPorCodigo($_GET['codigo']);
//        }else if(isset($_GET['proveedor']) && !empty($_GET['proveedor']) && preg_match('/^[A-Z0-9]{9}$/',$_GET['proveedor'])){
//            $data['productos'] = $model->filtrarPorProveedor($_GET['proveedor']);
//        }else if((isset($_GET['min_coste']) && is_numeric($_GET['min_coste'])) ||(isset($_GET['max_coste']) && is_numeric($_GET['max_coste'])) ){
//            if(is_numeric($_GET['min_coste']) && is_numeric($_GET['max_coste'])){
//                $data['productos'] = $model->filtrarMinMax((float)$_GET['min_coste'],(float)$_GET['max_coste'],'coste');
//            }else if(is_numeric($_GET['min_coste'])){
//                $data['productos'] = $model->filtrarMinMax((float)$_GET['min_coste'],-1,'coste');
//            }else{
//                $data['productos'] = $model->filtrarMinMax(-1,(float)$_GET['max_coste'],'coste');
//            }
//        }else if(is_numeric($_GET['min_stock']) && !empty($_GET['min_stock']) || is_numeric($_GET['max_stock']) && !empty($_GET['max_stock'])){
//            if(is_numeric($_GET['min_stock']) && is_numeric($_GET['max_stock'])){
//                $data['productos'] = $model->filtrarMinMax((float)$_GET['min_stock'],(float)$_GET['max_stock'], 'stock');
//            }else if(is_numeric($_GET['min_stock'])){
//                $data['productos'] = $model->filtrarMinMax((float)$_GET['min_stock'],-1,'stock');
//            }else{
//                $data['productos'] = $model->filtrarMinMax(-1,(float)$_GET['max_stock'],'stock');
//            }
//        }else{
//            $data['productos'] = $model->getAll();
//        }
          
        $this->view->showViews(array('templates/header.view.php','Productos.view.php','templates/footer.view.php'),$data);
    }
    
}