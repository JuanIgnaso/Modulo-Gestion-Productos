<?php
declare(strict_types = 1);
namespace Com\Daw2\Controllers;

class UsuarioController extends \Com\Daw2\Core\BaseController {
    
    function mostrarTodos(){
        $data = [];
        $model = new \Com\Daw2\Models\UsuarioModel();
        $rolModel = new \Com\Daw2\Models\AuxModel();
        $data['titulo'] = 'Mostrar Usuarios';
        $data['seccion'] = '/usuarios';
        $data['roles'] = $rolModel->getAll();
        $data['input'] = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);
        $data['usuarios'] = $model->filterAll($_GET);
        
//        if(isset($_GET['rol']) && is_array($_GET['rol'])){
//            $data['usuarios'] = $model->filtrarPorRol($_GET['rol']);
//        }else if(isset($_GET['username']) && !empty($_GET['username'])){
//           $data['usuarios'] = $model->filtrarPorUsuario($_GET['username']);
//        }else if((isset($_GET['min_salario']) && is_numeric($_GET['min_salario'])) ||(isset($_GET['max_salario']) && is_numeric($_GET['max_salario'])) ){
//            if(is_numeric($_GET['min_salario']) && is_numeric($_GET['max_salario'])){
//                 $data['usuarios'] = $model->filtrarPorSalario((float)$_GET['min_salario'], (float)$_GET['max_salario']);
//            }else if(is_numeric($_GET['min_salario'])){
//                $data['usuarios'] = $model->filtrarPorSalario((float)$_GET['min_salario'], -1);
//            }else{
//                 $data['usuarios'] = $model->filtrarPorSalario( -1,(float)$_GET['max_salario']);
//            }
//        }else if((isset($_GET['min_retencion']) && is_numeric($_GET['min_retencion'])) || (isset($_GET['max_retencion']) && is_numeric($_GET['max_retencion']))){
//            if(is_numeric($_GET['min_retencion']) && is_numeric($_GET['max_retencion'])){
//                $data['usuarios'] = $model->filtrarRetencionIRPF((float)$_GET['min_retencion'],(float) $_GET['max_retencion']);
//            }else if(is_numeric($_GET['min_retencion'])){
//                $data['usuarios'] = $model->filtrarRetencionIRPF((float)$_GET['min_retencion'],-1);
//            }else{
//                $data['usuarios'] = $model->filtrarRetencionIRPF(-1,(float)$_GET['max_retencion']);
//            }
//        }else{
//             $data['usuarios'] = $model->getAll();
//        }
        $this->view->showViews(array('templates/header.view.php','usuarios.view.php','templates/footer.view.php'),$data);
    }
    
    function mostrarPorSalario(){
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data['titulo'] = 'Usuarios Por Salario';
        $data['seccion'] = '/usuarios/ordenados';
        $data['usuarios'] = $model->ordenarSalario();
        $this->view->showViews(array('templates/header.view.php','usuariosOrdered.view.php','templates/footer.view.php'),$data);
    }
    
        function mostrarStandard(){
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data['titulo'] = 'Usuarios Standard';
        $data['seccion'] = '/usuarios/Standard';
        $data['usuarios'] = $model->getStandard();
        $this->view->showViews(array('templates/header.view.php','usuariosStandard.view.php','templates/footer.view.php'),$data);
    }
}