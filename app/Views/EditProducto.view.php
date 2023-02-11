<?php
    if(isset($error)){
        ?>
    <div class="col-12">
        <div class="alert alert-danger"><p><?php echo $error; ?></p></div>
    </div>
    <?php
    }
    ?>
 

    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post"  action="/producto/edit/<?php echo $producto[0]['cif']?>">
                <input type="hidden" name="codigo" value="<?php echo isset($input['codigo']) ? $producto[0]['codigo'] : $producto[0]['codigo'];?>"/>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Campos</h6>   
                </div> 
                <?phpvar_dump();?>
                <div class="card-body">
                    <div class="row">  
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo isset($input['nombre']) ? $producto[0]['nombre'] : $producto[0]['nombre']; ?>" />
                                <p class="text-danger small"><?php echo isset($errores['nombre']) ? $errores['nombre'] : '';?></p>
                            </div>
                        </div>  
 
                       <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="5"><?php echo isset($input['descripcion']) ? $producto[0]['descripcion'] : $producto[0]['descripcion']; ?></textarea>
                        <p class="text-danger small"><?php echo isset($errores['descripcion']) ? $errores['descripcion'] : '' ?></p>

                            </div>
                        </div> 
                         <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Coste:</label>
                                <input type="text" class="form-control" name="coste" id="coste" value="<?php echo isset($input['coste']) ? $producto[0]['coste'] : $producto[0]['coste']; ?>" />
                                <p class="text-danger small"><?php echo isset($errores['coste']) ? $errores['coste'] : '';?></p>
                            </div>
                        </div> 
                          <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Margen:</label>
                                <input type="text" class="form-control" name="margen" id="margen" value="<?php echo isset($input['margen']) ? $producto[0]['margen'] : $producto[0]['margen']; ?>" />
                                <p class="text-danger small"><?php echo isset($errores['margen']) ? $errores['margen'] : '';?></p>
                            </div>
                        </div> 
                           <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Stock:</label>
                                <input type="text" class="form-control" name="stock" id="stock" value="<?php echo isset($input['stock']) ? $producto[0]['stock'] : $producto[0]['stock']; ?>" />
                                <p class="text-danger small"><?php echo isset($errores['stock']) ? $errores['stock'] : '';?></p>
                            </div>
                        </div> 
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Categoría:</label>
                               <div class="mb-3">
                                <select name="categoria[]" id="proveedor" class="form-control select2" data-placeholder="Roles"  multiple>
                                    <option value="">-</option>
                                    <?php
                                    foreach ($categorias as $categoria) {
                                        ?>
                                        <option value="<?php echo $categoria['id_categoria']; ?>" <?php echo (isset($_GET['categoria']) && in_array($categoria['id_categoria'], $_GET['categoria'])) ? 'selected' : ''; ?>><?php echo $categoria['id_categoria']." - ".ucfirst($categoria['nombre_categoria']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                              <p><b class="text-primary">Categoría Actual: </b><?php echo isset($producto[0]['nombre_categoria']) ? $producto[0]['nombre_categoria'] : $producto[0]['nombre_categoria']; ?></p>
                            </div>
                        </div> 
                         <div class="col-12 col-lg-3">
                            <div class="mb-3">
                               <div class="mb-3">
                                <label for="username">Proveedores:</label>
                                <select name="proveedor[]" id="proveedor" class="form-control select2" data-placeholder="Roles"  multiple>
                                    <option value="">-</option>
                                    <?php
                                    foreach ($proveedores as $proveedor) {
                                        ?>
                                        <option value="<?php echo $proveedor['cif']; ?>" <?php echo (isset($_GET['proveedor']) && in_array($proveedor['cif'], $_GET['proveedor'])) ? 'selected' : ''; ?>><?php echo $proveedor['cif']." - ".ucfirst($proveedor['nombre']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>                               
                                <p><b class="text-primary">Proveedor Actual: </b><?php echo isset($producto[0]['cif']) ? $producto[0]['cif'] : $producto[0]['cif']; ?></p>                                
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">                     
                        <a href="/productos" value="" name="volver" class="btn btn-info">Volver</a>
                        <input type="submit" value="Editar Producto" class="btn btn-primary ml-2"/>
                    </div>
                </div>
               
            </form>
        </div>
    </div>                      
</div>

