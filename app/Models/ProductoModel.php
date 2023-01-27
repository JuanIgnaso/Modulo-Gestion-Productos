<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

declare(strict_types=1);

namespace Com\Daw2\Models;

class ProductoModel extends \Com\Daw2\Core\BaseModel{
    
    private const SELECT_ALL = 'SELECT producto.*,categoria.nombre_categoria FROM producto LEFT JOIN categoria ON categoria.id_categoria = producto.id_categoria';
    
    private const FIELDS_ORDER = ['codigo','nombre','proveedor','coste','margen','stock','iva','nombre_categoria'];
    private const ORDER_DEFECTO = 0;
    
    
    function getAll():array{
        $stmt = $this->pdo->query(self::SELECT_ALL);
        return $stmt->fetchAll();
    }
    
    function filtrarPorCategoria(array $categorias): array{
        $arrayValidos = [];
        foreach($categorias as $categoria){
            if(filter_var($categoria,FILTER_VALIDATE_INT)){
                $arrayValidos[] = (int)$categoria;
            }
        }
        if(count($arrayValidos) > 0){
            $query_categorias = implode(',',$arrayValidos);
            $query = self::SELECT_ALL." WHERE producto.id_categoria IN ($query_categorias)";
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll();
        }else{
            $stmt = $this->pdo->query(self::SELECT_ALL);
            return $stmt->fetchAll();
        }
    }
    
    function filtrarPorNombre(string $name): array{
        $stmt = $this->pdo->prepare(self::SELECT_ALL.' WHERE producto.nombre LIKE ?');
        $likenombre = "%$name%";
        $stmt->execute([$likenombre]);
        return $stmt->fetchAll();
    }
    
    function filtrarPorCodigo(string $codigo): array{
        $stmt = $this->pdo->prepare(self::SELECT_ALL.' WHERE producto.codigo LIKE ?');
        $likeCodigo = "%$codigo%";
        $stmt->execute([$likeCodigo]);
        return $stmt->fetchAll();
    }
    
        function filtrarPorProveedor(string $codigo): array{
        $stmt = $this->pdo->prepare(self::SELECT_ALL.' WHERE producto.proveedor LIKE ?');
        $likeCodigo = "%$codigo%";
        $stmt->execute([$likeCodigo]);
        return $stmt->fetchAll();
    }
    
    function filtrarMinMax(float $min, float $max, string $campo): array{
        $where  = "";
        $params = [];
        
        if($min != -1){
            $where .= " AND $campo >= :min";
            $params['min'] = $min;
        }
        if($max != -1){
            $where .= " AND $campo <= :max";
            $params['max'] = $max;
        }
        
        if(count($params) > 0){
            $where = substr($where,4);
            $query = self::SELECT_ALL." WHERE $where ORDER BY $campo DESC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }else{
            $stmt = $this->pdo->query(self::SELECT_ALL);
            return $stmt->fetchAll();
        }
    }
    
    function filterAll(array $filtros):array{
        $conditions = [];
        $parameters = [];
        
        if(isset($filtros['categoria']) && is_array($filtros['categoria'])){
                        $contador = 1;
            $condicionesRol = [];
            foreach($filtros['categoria'] as $categoria){
                if(filter_var($categoria, FILTER_VALIDATE_INT)){
                    $condicionesRol[] = ':categoria'.$contador;
                    $parameters['categoria'.$contador] = $categoria;
                    $contador++;
                }
            }
            if(count($parameters) > 0){
                $conditions[] = 'producto.id_categoria IN ('.implode(',', $condicionesRol).')';
                
            }
        }
        if(isset($filtros['codigo']) && !empty($filtros['codigo']) && preg_match('/^ACE0000[0-9]{3}$/',$filtros['codigo'])){
            $conditions[] = " producto.codigo LIKE ?";
        }
        if(isset($filtros['nombre']) && !empty($filtros['nombre'])){
            $conditions[] = "nombre LIKE ?";
            $parameters[] = "%".$filtros['nombre']."%";
        }
        
        if(isset($filtros['proveedor']) && !empty($filtros['proveedor']) && preg_match('/^[A-Z0-9]{9}$/',$filtros['proveedor'])){
            $conditions[]= "proveedor LIKE ?";
            $parameters[] = "%".$filtros['proveedor']."%";
        }
        
        if((isset($filtros['min_coste']) && !empty($filtros['min_coste'])) || (isset($filtros['max_coste']) && !empty($filtros['max_coste']))){
            if(is_numeric($filtros['min_coste']) && $filtros['min_coste'] != -1){
                $conditions[] = " coste >= ?";
                $parameters[] = $filtros['min_coste'];
            }
                if(is_numeric($filtros['max_coste']) && $filtros['max_coste'] != -1){
                $conditions[] = " coste <= ?";
                $parameters[] = $filtros['max_coste'];
            }
        }
        
        if((isset($filtros['min_stock']) && !empty($filtros['min_stock'])) || (isset($filtros['max_stock']) && !empty($filtros['max_stock']))){
            if(is_numeric($filtros['min_stock']) && $filtros['min_stock'] != -1){
                $conditions[] = " stock >= ?";
                $parameters[] = $filtros['min_stock'];
            }
                if(is_numeric($filtros['max_stock']) && $filtros['max_stock'] != -1){
                $conditions[] = " stock <= ?";
                $parameters[] = $filtros['max_stock'];
            }
        }
        
        if(isset($filtros['order']) && filter_Var($filtros['order'],FILTER_VALIDATE_INT)){
            if($filtros['order'] <= count(self::FIELDS_ORDER) && $filtros['order'] >= 1){
                $fieldOrder =  self::FIELDS_ORDER[$filtros['order'] -1];
            }else{
                $filtros['order'] = self::ORDER_DEFECTO;
                $fieldOrder = self::FIELDS_ORDER[self::ORDER_DEFECTO];
            }
        } else {
            $filtros['order'] = self::ORDER_DEFECTO;
            $fieldOrder = self::FIELDS_ORDER[self::ORDER_DEFECTO];
      }
      
      if(count($parameters) > 0){
          $sql = self::SELECT_ALL." WHERE ".implode(" AND ",$conditions)." ORDER BY $fieldOrder";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute($parameters);
          echo $sql;
          return $stmt->fetchAll();
          
      }else{
          $stmt =  $this->pdo->query(self::SELECT_ALL." ORDER BY $fieldOrder");
          return $stmt->fetchAll();
      }
    }
    
    function insertarCampo(array $datos):bool{    
        $descripcion = "";
        if(empty($datos['add_descripcion'])){
          $descripcion = "Inserte una Descripción";
        }else{
            $descripcion = $datos['add_descripcion'];
        }
       
        $query = $this->db->prepare("INSERT INTO producto (codigo, nombre, descripcion, proveedor, coste,margen,stock,iva,id_categoria) values (:codigo, :nombre, :descripcion, :proveedor, :coste, :margen, :stock, :iva, :id:_categoria)");
        //stock,iva,id_categoria
        $query->execute(
                [
                'codigo' => $datos['add_codigo'],
                 'nombre' => $datos['add_nombre'],
                 'descripcion' =>  $descripcion,
                 'proveedor' => 'E5000065M',
                 'coste' => $datos['add_coste'], 
                 'stock' => $datos['add_stock'],
                 'iva' => 21,   
                  'categoria' => $datos['add_categoria'],  
                ]
        );
        
    }
    
  
    
    
    function borrarCampo(){
        
    }
}

