<?php //


namespace Com\Daw2\Controllers;

class ProveedorController extends \Com\Daw2\Core\BaseController{
    
    
    function showAll(){
        $model = new \Com\Daw2\Models\ProveedorModel();
        $data = [];
        $data['proveedores'] = $model->getAll();
        $data['titulo'] = 'Lista de Proveedores';
        $data['seccion'] = '/proveedores';
        $data['input'] = filter_Var_Array($_GET,FILTER_SANITIZE_SPECIAL_CHARS);
        
        $this->view->showViews(array('templates/header.view.php','ProveedoresView.php','templates/footer.view.php'),$data);     
    }
}
