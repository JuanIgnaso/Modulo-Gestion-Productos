<div class="row">       
    <?php
    if(isset($anadir_Campo) && $anadir_Campo = false){
        ?>
    <div class="col-12">
        <div class="alert alert-danger"><p>No se ha podido añadir el campo</p></div>
    </div>
    <?php
    }
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get"  action="/productos">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>   
                </div> 
                
                <div class="card-body">
                    <div class="row">
                           <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <select name="categoria[]" id="categoria" class="form-control select2" data-placeholder="Roles"  multiple>
                                    <option value="">-</option>
                                    <?php
                                    foreach ($categorias as $categoria) {
                                        ?>
                                        <option value="<?php echo $categoria['id_categoria']; ?>" <?php echo (isset($_GET['categoria']) && in_array($categoria['id_categoria'], $_GET['categoria'])) ? 'selected' : ''; ?>><?php echo ucfirst($categoria['nombre_categoria']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">                      
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Codigo:</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" value="<?php echo isset($input['codigo']) ? $input['codigo'] : ''; ?>" />
                            </div>
                        </div>   
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="salarioBruto">Nombre:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo isset($input['nombre']) ? $input['nombre'] : ''; ?>" placeholder="nombre" />
                                    </div>
                                </div>
                            </div>
                        </div>   
                           <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="salarioBruto">Proveedor:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="proveedor" id="proveedor" value="<?php echo isset($input['proveedor']) ? $input['proveedor'] : ''; ?>" placeholder="nombre" />
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="retencion">Coste:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="min_coste" id="min_coste" value="<?php echo isset($input['min_coste']) ? $input['min_coste'] : ''; ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="max_coste" id="max_coste" value="<?php echo isset($input['max_coste']) ? $input['max_coste'] : ''; ?>" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div> 
                        
                                                <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="retencion">Stock:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="min_stock" id="min_stock" value="<?php echo isset($input['min_stock']) ? $input['min_stock'] : ''; ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="max_stock" id="max_stock" value="<?php echo isset($input['max_stock']) ? $input['max_stock'] : ''; ?>" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">                     
                        <a href="/usuarios" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                        <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
               
            </form>
        </div>
    </div>
  
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Datos del CSV</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <?php 
                if(count($productos)  >  0){                                    
                ?>
                <!--<form action="./?sec=formulario" method="post">     -->
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <th><a href="/productos?order=1">Código</a></th>
                            <th><a href="/productos?order=2">Nombre</a></th>
                            <th>Descripción</th>
                            <th><a href="/productos?order=3">Proveedor</a></th>
                            <th><a href="/productos?order=4">Coste</a></th>
                            <th><a href="/productos?order=5">Margen</a></th>
                            <th><a href="/productos?order=6">Stock</a></th>
                            <th><a href="/productos?order=7">IVA</a></th>
                            <th><a href="/productos?order=8">Categoría</a></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            foreach($productos as $producto){
                            ?>
                        <tr>
                            <td><?php echo $producto['codigo'];?></td>
                            <td><?php echo $producto['nombre'];?></td>
                             <td><?php echo $producto['descripcion'];?></td>
                            <td><?php echo $producto['proveedor'];?></td>
                            <td><?php echo $producto['coste'];?></td>
                            <td><?php echo $producto['margen'];?></td>
                            <td><?php echo $producto['stock'];?></td>
                            <td><?php echo $producto['iva'];?></td>
                            <td><?php echo $producto['nombre_categoria'];?></td>
                           
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>           
                </table>
                <?php
                }
                else{
                ?>
                <p class="text-danger">No existen registros en la tabla.</p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>                        
</div>

<!--                  <?php                    
                           /* foreach($usuarios as $usuario){
                            ?>
                        <tr>
                                <td><?php echo $usuario['username']; ?></td>
                                <td><?php echo $usuario['nombre_rol']?></td>
                                <td><?php echo $usuario['salarioBruto']?></td>
                                <td><?php echo $usuario['retencionIRPF']?></td>
                        </tr>    
                            <?php
                            }
                            echo '</tr>';
                        
                        */?>  -->