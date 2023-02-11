<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

declare(strict_types = 1);
namespace Com\Daw2\Models;

class ProductosModel extends \Com\Daw2\Core\BaseModel{
    
        private const SELECT_ALL = "SELECT producto.*,categoria.nombre_categoria,proveedor.cif FROM producto LEFT JOIN categoria ON producto.id_categoria = categoria.id_categoria LEFT JOIN proveedor ON producto.proveedor = proveedor.cif";
        private const FROM =  "FROM producto LEFT JOIN categoria ON producto.id_categoria = categoria.id_categoria LEFT JOIN proveedor ON producto.proveedor = proveedor.cif";
        private const COUNT_FROM = 'SELECT COUNT(*) as total '. self::FROM;
        private const INSERT_INTO = "INSERT INTO producto(codigo,nombre,descripcion,proveedor,coste,margen,stock,iva,id_categoria)";
        private const UPDATE = "UPDATE producto SET ";
        
        //ORDENACION DE CAMPOS
        
        //Permitir ordenación por código, nombre, proveedor, categoría y stock.
        private const FIELD_ORDER = ['codigo','nombre','proveedor','id_categoria','stock'];
        private const DEFAULT_ORDER = 0;
       
        
        function showAll(): int{
            $stmt = $this->pdo->query(self::SELECT_ALL);
            return $stmt->rowCount();
        }
        
        /***
         * Función que sirve para mostrar los datos del producto a editar en la vista
         */
       function showProducto(string $codigo): array{
        $stmt = $this->pdo->prepare(self::SELECT_ALL.' WHERE producto.codigo=?');
        $stmt->execute([$codigo]);  
        return $stmt->fetchAll();
        }
        
        function existeProducto(string $codigo): bool{
            $stmt = $this->pdo->prepare('SELECT * FROM producto WHERE codigo = ?');
            $stmt->execute([$codigo]);
            $o = $stmt->rowCount();
            return $o != 0;
        }
        
        function addProducto(array $post):int{
            $valores = $post;
            $tamano = $this->showAll();
            
            if(empty($valores['descripcion'])){
                $valores['descripcion'] = 'Inserte una descripción.';
            }
            $valores['iva'] = 21;
            $stmt = $this->pdo->prepare(self::INSERT_INTO." VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$valores['codigo'], $valores['nombre'], $valores['descripcion'], $valores['proveedor'][0], $valores['coste'], $valores['margen'], $valores['stock'], $valores['iva'],$valores['categoria'][0]]);
            $tamano_nuevo = $this->showAll();
             if(($tamano + 1) == $tamano_nuevo){
                 return 1;
             }else{
                 return 0;
             }
        }
        /*
            Codigo, proveedor, categoria
         */
        
        
       function mostrarConsulta(array $filtros,int $tamPag): array{
           
           $resultado  = $this->filterAll($filtros);
            $conditions = $resultado['condiciones']; 
            $parameters = $resultado['parametros'];
            
            //Aplicación del filtro ORDER
            if(isset($filtros['order']) && filter_var($filtros['order'],FILTER_VALIDATE_INT)){
                if($filtros['order'] <= count(self::FIELD_ORDER) && $filtros['order'] >= 1){
                    $fieldOrder = self::FIELD_ORDER[$filtros['order'] -1];
                }else{
                    $filtros['order'] = self::DEFAULT_ORDER;
                    $fieldOrder = self::FIELD_ORDER[self::DEFAULT_ORDER];
                }
            }else{
              $filtros['order'] = self::DEFAULT_ORDER;
              $fieldOrder = self::FIELD_ORDER[self::DEFAULT_ORDER];  
            }
            
            $pagina = (isset($filtros['page']) && filter_var($filtros['page'], FILTER_VALIDATE_INT) && $filtros['page'] > 0) ? (int) $filtros['page'] : 1;        
            $registroInicial = ($pagina - 1) * $tamPag;        
            $limit = " LIMIT $registroInicial, $tamPag";
            
           
           if(count($parameters) > 0){
               $sql = self::SELECT_ALL." WHERE ".implode(" AND ",$conditions)." ORDER BY "."$fieldOrder $limit";
               var_dump($sql);
               $stmt = $this->pdo->prepare($sql);
               $stmt->execute($parameters);
               return $stmt->fetchAll();
           }else{
               $stmt = $this->pdo->query(self::SELECT_ALL." ORDER BY "."$fieldOrder $limit");
               return $stmt->fetchAll();
           }
        }
        
        function delete(string $codigo):int{
            $stmt = $this->pdo->prepare('DELETE FROM producto WHERE codigo =?');
            $stmt->execute([$codigo]);
            if($stmt->rowCount() != 0){
                return 1;
            }else{
                return 0;
            }
        }
        
        private function filterAll(array $filtros): array{
            $resultado = [];
            $conditions = [];
            $parameters = [];
            
                if(isset($filtros['proveedor']) && is_array($filtros['proveedor'])){
               $contador = 1;
               $condicionesRol = [];
               foreach($filtros['proveedor'] as $proveedor){
                   if(filter_Var($proveedor,FILTER_VALIDATE_INT));
                   $condicionesRol[] = ':proveedor'.$contador;
                   $parameters['proveedor'.$contador] = $proveedor;
                   $contador++;
               }
           }
           if(count($parameters) > 0){
               $conditions[] = 'producto.proveedor IN ('.implode(',',$condicionesRol).')';
           }
            
            if(isset($filtros['codigo']) && !empty($filtros['codigo'])){
                $parameters['codigo'] = '%'.$filtros['codigo'].'%';
                $conditions[] = ' producto.codigo LIKE :codigo';
            }
            $condicionesCategoria = [];
               if(isset($filtros['categoria']) && is_array($filtros['categoria'])){
               $contador = 1;

               foreach($filtros['categoria'] as $categoria){
                   if(filter_Var($categoria,FILTER_VALIDATE_INT));
                   $condicionesCategoria[] = ':categoria'.$contador;
                   $parameters['categoria'.$contador] = $categoria;
                   $contador++;
               }
           }
           if(count($condicionesCategoria) > 0){
               $conditions[] = 'producto.id_categoria IN ('.implode(',',$condicionesCategoria).')';
           }
           
           $resultado['parametros'] = $parameters;
           $resultado['condiciones'] = $conditions;
           
           return $resultado;
        }
        
        
        function count(array $filtros) : int{
        $procesado = $this->filterAll($filtros);
        
        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];
        
        if(count($parametros) > 0){
            $sql = self::COUNT_FROM.' WHERE '.implode(" AND ", $condiciones);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);
            $res = $stmt->fetchAll();
            return $res[0]['total'];
        }
        else{
            $stmt = $this->pdo->query(self::COUNT_FROM);
            $res = $stmt->fetchAll();
            return $res[0]['total'];
        }
    }
    
    function edit(string $codigo, string $nombre, string $descripcion, string $proveedor, float $coste, float $margen, int $stock, int $categoria): bool{
      
            $stmt = $this->pdo->prepare("UPDATE producto SET nombre=?,descripcion=?,proveedor=?,coste=?,margen=?,stock=?,id_categoria=? WHERE codigo=?");
           return $stmt->execute([
             
             $nombre,
             $descripcion,
             $proveedor,
             $coste,
             $margen,
             $stock,
             $categoria,
             $codigo
            ]);
            
    
        }
        
}