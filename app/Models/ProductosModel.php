<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

declare(strict_types = 1);
namespace Com\Daw2\Models;

class ProductosModel extends \Com\Daw2\Core\BaseModel{
    
        private const SELECT_ALL = "SELECT producto.*,categoria.nombre_categoria FROM producto LEFT JOIN categoria ON producto.id_categoria = categoria.id_categoria";

        function showAll(): array{
            $stmt = $this->pdo->query(self::SELECT_ALL);
            return $stmt->fetchAll();
        }
}