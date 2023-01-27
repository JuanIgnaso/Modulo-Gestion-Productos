<?php

declare(strict_types=1);

namespace Com\Daw2\Models;



class ProveedorModel extends \Com\Daw2\Core\BaseModel{
 function getAll(): array{
        $stmt = $this->pdo->query('SELECT * FROM proveedor ORDER BY cif');
        return $stmt->fetchAll();
    }
    
}