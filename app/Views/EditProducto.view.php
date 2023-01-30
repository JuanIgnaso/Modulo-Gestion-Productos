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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Campos</h6>   
                </div> 
                
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

