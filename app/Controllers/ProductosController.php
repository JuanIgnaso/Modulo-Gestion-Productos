<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

declare(strict_types = 1);
namespace Com\Daw2\Controllers;

class ProductosController extends \Com\Daw2\Core\BaseController{
    
    private const PATRON_CODIGO = '/^[A-Z]{3}\d{7}$/';
    
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
    
    
    function add(){
        $modelProv = new \Com\Daw2\Models\ProveedorModel();
        $modelC = new \Com\Daw2\Models\CategoriaModel();
        $data=[];
        $data['titulo'] = 'Alta Productos';
        $data['seccion'] = '/addProducto';
        $data['errores'] = $this->checkAdd($_POST);
        $data['proveedores'] = $modelProv->getAll();
        $data['categorias'] = $modelC->getAll();

        
        if(count($data['errores']) == 0){
           $model = new \Com\Daw2\Models\ProductosModel();
            $resultado =  $model->addProducto($_POST);
            if($resultado == 1){
                var_dump($data['errores']);
                header('Location: /productos');
            }else if($resultado == 0){
                 var_dump($data['errores']);
            }
        }else{

            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header.view.php','AltaProducto.view','templates/footer.view.php'),$data);         
        }
       
    }
    
    function checkAdd(array $post): array{
        //codigo, nombre, descripción, coste, margen, stock
        $model = new \Com\Daw2\Models\ProductosModel();
        
        $errores = [];
        if(empty($post['codigo'])){
            $errores['codigo'] = 'Este campo es obligatorio.';
        }else if(!preg_match(self::PATRON_CODIGO,$post['codigo'])){
            $errores['codigo'] = 'Formato de codigo debe de ser LLL0000000.';
        }
        
        if($model->existeProducto($post['codigo'])){
             $errores['codigo'] = 'El codigo del producto introducido ya existe.';
        }

        if(empty($post['nombre'])){
             $errores['nombre'] = 'Este campo es obligatorio.';
        }
        if(empty($post['coste'])){
             $errores['coste'] = 'Este campo es obligatorio.';
        }
        if(!filter_var($post['coste'],FILTER_VALIDATE_FLOAT)){
            $errores['coste'] = 'El coste debe de ser un número.';
        }else if($post['coste'] <= 0){
            $errores['coste'] = 'El valor debe de ser mayor a 0.';
        }
        
         if(empty($post['margen'])){
             $errores['margen'] = 'Este campo es obligatorio.';
        }
         if(!filter_var($post['margen'],FILTER_VALIDATE_FLOAT)){
            $errores['margen'] = 'El margen debe de ser un número.';
        }else if($post['margen'] <= 0){
            $errores['margen'] = 'El valor debe de ser mayor a 0.';
        }
        
        
        if(empty($post['stock'])){
             $errores['stock'] = 'Este campo es obligatorio.';
        }
    if(!filter_var($post['stock'],FILTER_VALIDATE_INT)){
            $errores['stock'] = 'El stock debe de ser un número.';
        }else if($post['stock'] <= 0){
            $errores['stock'] = 'El valor debe de ser mayor a 0.';
        } 
        if(empty($post['categoria'])){
             $errores['categoria'] = 'Este campo es obligatorio.';
        }
        if(empty($post['proveedor'])){
             $errores['proveedor'] = 'Este campo es obligatorio.';
        }
        return $errores;      
    }
    
    function checkEdit(array $post): array{
        $model = new \Com\Daw2\Models\ProductosModel();
        
        $errores = [];
        if(empty($post['nombre'])){
             $errores['nombre'] = 'Este campo es obligatorio.';
        }
        if(empty($post['coste'])){
             $errores['coste'] = 'Este campo es obligatorio.';
        }
        if(!filter_var($post['coste'],FILTER_VALIDATE_FLOAT)){
            $errores['coste'] = 'El coste debe de ser un número.';
        }else if($post['coste'] <= 0){
            $errores['coste'] = 'El valor debe de ser mayor a 0.';
        }
        
         if(empty($post['margen'])){
             $errores['margen'] = 'Este campo es obligatorio.';
        }
         if(!filter_var($post['margen'],FILTER_VALIDATE_FLOAT)){
            $errores['margen'] = 'El margen debe de ser un número.';
        }else if($post['margen'] <= 0){
            $errores['margen'] = 'El valor debe de ser mayor a 0.';
        }     
        
        if(empty($post['stock'])){
             $errores['stock'] = 'Este campo es obligatorio.';
        }
    if(!filter_var($post['stock'],FILTER_VALIDATE_INT)){
            $errores['stock'] = 'El stock debe de ser un número.';
        }else if($post['stock'] <= 0){
            $errores['stock'] = 'El valor debe de ser mayor a 0.';
        } 
        /*if(empty($post['categoria'])){
             $errores['categoria'] = 'Este campo es obligatorio.';
        }
        if(empty($post['proveedor'])){
             $errores['proveedor'] = 'Este campo es obligatorio.';
        }*/
        return $errores;      
    }
    
    function delete(string $codigo){
        $modelo = new \Com\Daw2\Models\ProductosModel();
        $result = $modelo->delete($codigo);
        $mensaje = '';
        if($result == 1){
            header('Location: /productos');
        }else{
        $mensaje = 'Ha ocurrido un error al intentar eliminar el producto seleccionado.';
        $this->cant_delete($mensaje);
            
        }
    }
    
    function cant_delete(string $mensaje){
        $data = [];
        $data['mensaje'] = $mensaje;
        $data['seccion'] = '/productos';
        $this->view->showViews(array('templates/header.view.php','CantDelete.view.php','templates/footer.view.php'),$data);
    }
    
    
    function mostrarEdit($codigo){
        $data = [];
        $data['titulo'] = 'Producto '.$codigo;
        $data['seccion'] = '/producto/edit/'.$codigo;
        $modelProv = new \Com\Daw2\Models\ProveedorModel();
        $modelC = new \Com\Daw2\Models\CategoriaModel();
        $modelo = new \Com\Daw2\Models\ProductosModel();
        $data['proveedores'] = $modelProv->getAll();
        $data['categorias'] = $modelC->getAll();
        $data['producto'] = $modelo->showProducto($codigo);
        
        $this->view->showViews(array('templates/header.view.php','EditProducto.view.php','templates/footer.view.php'),$data);     
    }
    
    function edit($codigo){
        $data = [];
        $data['titulo'] = 'Producto '.$codigo;
        $data['seccion'] = '/producto/edit/'.$codigo;
        $data['errores'] = $this->checkEdit($_POST);
        if(count($data['errores']) === 0){
            $model = new \Com\Daw2\Models\ProductosModel();
            $resultado = $model->edit($codigo,$_POST['nombre'],$_POST['descripcion'],$_POST['proveedor'][0],(float)$_POST['coste'],(float)$_POST['margen'],(int)$_POST['stock'],(int)$_POST['categoria'][0]);
            if($resultado){
                var_dump($resultado);
                //header('Location: /productos');
            }else{
                $this->mostrarEdit($codigo);
                //$data['error'] = 'Error al intentar modificar el producto';
            }
        }else{           
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $this->view->showViews(array('templates/header.view.php','EditProducto.view.php','templates/footer.view.php'),$data);       
        }
    }
}