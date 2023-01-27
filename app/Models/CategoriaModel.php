<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

declare(strict_types=1);

namespace Com\Daw2\Models;



class CategoriaModel extends \Com\Daw2\Core\BaseModel{
 function getAll(): array{
        $stmt = $this->pdo->query('SELECT * FROM categoria ORDER BY id_categoria');
        return $stmt->fetchAll();
    }
    
}