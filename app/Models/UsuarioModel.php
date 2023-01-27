<?php

/*
SENTENCIAS NORMALES
 * $this->pdo->query("SELECT * FROM usuario WHERE username LIKE %nombre%;
 * $stmt ->fetchAll();
 * 
 * SENTENCIAS PREPARADAS
 * $this->pdo->prepare("SELECT * FROM usuario WHERE username LIKE ?;
 * $stmt->execute([$likeUserName]);
 * $stmt->fetchAll();
 *  */
declare(strict_types=1);

namespace Com\Daw2\Models;

class UsuarioModel extends \Com\Daw2\Core\BaseModel{
    
    private const SELECT = 'SELECT usuario.*, aux_rol.nombre_rol FROM usuario LEFT JOIN aux_rol ON aux_rol.ID_rol = usuario.ID_rol';
    private const FIELDS_ORDER = ['username','nombre_rol','salarioBruto','retencionIRPF'];
    private const ORDER_DEFECTO = 0;
    
    
    function getAll(): array{
        $stmt = $this->pdo->query(self::SELECT);
        return $stmt->fetchAll();
    }
    
    function filtrarPorRol(array $roles): array{
        $arrayValidos = [];
        foreach($roles as $rol){
            if(filter_var($rol,FILTER_VALIDATE_INT)){
                $arrayValidos[] =(int) $rol;
            }
        }
        if(count($arrayValidos) > 0){
            $query_roles = implode(',',$arrayValidos);
            $query = self::SELECT." WHERE usuario.ID_rol IN ($query_roles)";
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll();
        }else{
            $stmt = $this->pdo->query(self::SELECT);
           return $stmt->fetchAll();
        }      
    }
    
    function filtrarPorUsuario(string $username): array{
        $stmt = $this->pdo->prepare(self::SELECT.' WHERE  usuario.username LIKE  ?');
        $likeUserName = "%$username%";
        $stmt->execute([$likeUserName]);
        return $stmt->fetchAll();
    }
    
    function filtrarPorSalario(float $min, float $max): array{
        $where  = "";
        $params = [];
        //Aqui se prepara la consulta:
        //Si se cumple alguna de las situaciones
        if($min != -1){
            $where .= " AND salarioBruto >= :min";
            $params['min'] = $min;
        }
        if($max != -1){
            $where .= " AND salarioBruto <= :max";
            $params['max'] = $max;
        }
        if(count($params) > 0){
            $where = substr($where, 4);
            $query = self::SELECT." WHERE $where ORDER BY salarioBruto DESC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }else{
            $stmt = $this->pdo->query(self::SELECT);
            return $stmt->fetchAll;
        }
    }
    

    function filtrarRetencionIRPF(float $min, float $max): array{
        $where = "";
        $params = [];
        if($min !=  -1){
            $where.=" AND retencionIRPF >= :min";
            $params['min'] = $min;
        }
        if($max != -1){
            $where.=" AND retencionIRPF <= :max";
              $params['max'] = $max;
        }
        if(count($params) > 0){
            $where = substr($where,4);
            $query = self::SELECT." WHERE $where ORDER BY retencionIRPF DESC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }else{
            $query = self::SELECT;
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll();
        }
    }
    
    function filterAll(array $filtros):array{
        $conditions = [];
        $parameters = [];
        
      if(isset($filtros['rol']) && is_array($filtros['rol'])){
            $contador = 1;
            $condicionesRol = [];
            foreach($filtros['rol'] as $rol){
                if(filter_var($rol, FILTER_VALIDATE_INT)){
                    $condicionesRol[] = ':rol'.$contador;
                    $parameters['rol'.$contador] = $rol;
                    $contador++;
                }
            }
            if(count($parameters) > 0){
                $conditions[] = 'usuario.id_rol IN ('.implode(',', $condicionesRol).')';
                
            }
        }
        //Para buscar por un nombre
        if(isset($filtros['username']) && !empty($filtros['username'])){
            $parameters[] = '%'.$filtros['username'].'%';
            $conditions[] = " username LIKE  ?";
        }
        //Para campos numéricos que queramos que estén entre un rango
        if((isset($filtros['min_salario']) && !empty($filtros['min_salario']))  || (isset($filtros['max_salario']) && !empty($filtros['max_salario']))){
            if(is_numeric($filtros['min_salario']) && $filtros['min_salario'] != -1){
                $conditions[] = " salarioBruto >= ?";
                $parameters[] = $filtros['min_salario'];
            }
              if(is_numeric($filtros['max_salario']) && $filtros['max_salario'] != -1){
                $conditions[] = " salarioBruto <= ?";
                $parameters[] = $filtros['max_salario'];
            }
        } 
        
                if((isset($filtros['min_retencion']) && !empty($filtros['min_retencion']))  || (isset($filtros['max_retencion']) && !empty($filtros['max_retencion']))){
            if(is_numeric($filtros['min_retencion']) && $filtros['min_retencion'] != -1){
                $conditions[] = " retencionIRPF >= ?";
                $parameters[] = $filtros['min_retencion'];
            }
              if(is_numeric($filtros['max_retencion']) && $filtros['max_retencion'] != -1){
                $conditions[] = " retencionIRPF <= ?";
                $parameters[] = $filtros['max_retencion'];
            }
        } 
        
        //Cuando esté seteado el order en la vista
        if(isset($filtros['order']) && filter_var($filtros['order'],FILTER_VALIDATE_INT)){
            if($filtros['order'] <= count(self::FIELDS_ORDER) && $filtros['order'] >= 1){
                $fieldOrder = self::FIELDS_ORDER[$filtros['order'] -1];
            }else{
                $filtros['order'] = self::ORDER_DEFECTO;
                $fieldOrder = self::FIELDS_ORDER[self::ORDER_DEFECTO];
            }
        }else{
               $filtros['order'] = self::ORDER_DEFECTO;
                $fieldOrder = self::FIELDS_ORDER[self::ORDER_DEFECTO];
        }
        
        
        if(count($parameters) > 0){
         $sql = self::SELECT." WHERE ".implode(" AND ",$conditions)." ORDER BY $fieldOrder";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);
        return $stmt->fetchAll();
        }else{
            $stmt = $this->pdo->query(self::SELECT." ORDER BY $fieldOrder");
              return $stmt->fetchAll();
        }
        
    }

    
    function ordenarSalario(): array{
         $stmt = $this->pdo->query(self::SELECT.' ORDER BY salarioBruto DESC');
        return $stmt->fetchAll();
    }
    
    function getStandard(): array{
        $stmt = $this->pdo->query('SELECT  * FROM usuario WHERE rol = "Standard"');
        return $stmt->fetchAll();
    }
    
}
