<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

namespace Com\Daw2\Helpers;

class Rol{
    private $idRol;
    private $rol;
    private $descripcionEs;
    private $descripcionEn;
    private $_permisos;
    
    private static $_PERMISOS_ADMIN = array(
            'UsuariosSistema' => ['r', 'w', 'x', 'd']
    );    
    
    public function __construct(int $idRol, string $rol, string $descripcionEs, string $descripcionEn) {
        $this->descripcionEn = $descripcionEn;
        $this->descripcionEs = $descripcionEs;
        $this->idRol = $idRol;
        $this->rol = $rol;
        if($idRol == 1){
            $this->_permisos = self::$_PERMISOS_ADMIN;
        }
    }
    
    public function getIdRol() : int{
        return $this->idRol;
    }

    public function getNombreRol() : string{
        return $this->rol;
    }

    public function getDescripcionEs() : string {
        return $this->descripcionEs;
    }

    public function getDescripcionEn() : string{
        return $this->descripcionEn;
    }
    
    public function checkPermiso(string $controller, string $operacion) : bool{
        if(isset($this->_permisos[$controller])){
            return in_array($operacion, $this->_permisos[$operacion]);
        }
        else{
            return false;
        }
    }

}