<?php

namespace Com\Daw2\Controllers;

class InicioController extends \Com\Daw2\Core\BaseController {

    public function index() {
        
        if(isset($_SESSION['user'])){
             $data = array(
            'titulo' => 'Página de inicio',
            'breadcrumb' => ['Inicio']
        );        
        $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'), $data);  
        }else{
          $controler = new \Com\Daw2\Controllers\UsuarioSistemaController();
          $controler->login();  
        }
     
    }

}
