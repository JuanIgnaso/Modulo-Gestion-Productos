<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

namespace Com\Daw2\Models;

class UsuarioSistemaModel extends \Com\Daw2\Core\BaseModel{
    
 private const SELECT_ALL = 'SELECT * FROM usuario_sistema ';
 
    
    
 //Funcion del modelo para loguear usuarios, necesitamos pasar email y contraseña
 public function login(string $email, string $password): ?\Com\Daw2\Helpers\UsuarioSistema{
     //1-Buscamos si el usuario existe
     $query = $thi->pdo->prepare(self::SELECT_ALL." LEFT JOIN rol ON rol.id_rol=usuario_sistema.id_rol WHERE email=? AND baja=0");
     $query->execute([$email]);
     //2-Si hay coincidencias se devuelve el usuario del sistema
     if($row = $query->fetch()){
         //3-Hacemos la comprobacion de contraseña
         if(password_verify($password,$row['pass'])){
             return $this->rowToUsuarioSistema($row);
         }else{
             return NULL;
         }
     }
     return NULL;
 }   
 
 private function rowToUsuarioSistema(array $row): ?\Com\Daw2\Helpers\UsuarioSistema{
     //Se convierte la columna pasada en la consulta del login en un nuevo Objeto UsuarioSistema
    $rol = new \Com\Daw2\Helpers\Rol($row['id_rol'],$row['rol'],$row['descripcion_es'],$row['descripcion_en']); 
    return new \Com\Daw2\Helpers\UsuarioSistema($row['id_usuario'],$rol,$row['email'],$row['nombre'],$row['idioma'],(string)$row['baja']);
    
 }
    
}