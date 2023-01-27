<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class AuxModel extends \Com\Daw2\Core\BaseModel{
    
    function getAll(): array{
        $stmt = $this->pdo->query('SELECT * FROM aux_rol ORDER BY nombre_rol');
        return $stmt->fetchAll();
    }
}

