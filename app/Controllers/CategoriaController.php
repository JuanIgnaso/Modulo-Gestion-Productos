<?php


namespace Com\Daw2\Controllers;

class CategoriaController extends \Com\Daw2\Core\BaseController{
    
    function showAll(){
        $model = new \Com\Daw2\Models\CategoriaModel();
        $data = [];
        $data['categorias'] = $model->getAll();
        $data['input'] = filter_var_array($_GET,FILTER_SANITIZE_SPECIAL_CHARS);
        $data['titulo'] = 'Lista de Categorias';
        $data['seccion'] = '/categorias';
        
        $this->view->showViews(array('templates/header.view.php','Categorias.view.php','templates/footer.view.php'),$data);
    }
}