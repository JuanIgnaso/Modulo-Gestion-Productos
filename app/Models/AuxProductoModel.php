<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class AuxProductoModel extends \Com\Daw2\Core\BaseModel{
    
    function getAll(): array{
        $stmt = $this->pdo->query("SELECT * FROM categoria ORDER BY nombre_categoria");
        return $stmt->fetchAll();
    }
}

