<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

namespace Com\Daw2\Models;

class RolModel extends \Com\Daw2\Core\BaseModel{
    
    
   function getAll(): array{
     $stmt = $this->pdo->query('SELECT * FROM rol ORDER BY id_rol');
     return $stmt->fetchAll();
 }
}