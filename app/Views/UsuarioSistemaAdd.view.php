<?php
    if(isset($error_add)){
        ?>
    <div class="col-12">
        <div class="alert alert-danger"><p><?php echo $error_add; ?></p></div>
    </div>
    <?php
    }
    ?>
<!-- codigo, nombre, descripcion, coste, margen, stock, categoria, proveedor -->

    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post"  action="/usuarios_sistema/add">
                <!-- INPUT HIDDEN -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Campos</h6>   
                </div> 
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($input['email']) ? $input['email'] : '';?>" />
                                <p class="text-danger small"><?php echo isset($errores['email']) ? $errores['email'] : '';?></p>
                            </div>
                        </div>    
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo isset($input['nombre']) ? $input['nombre'] : '';?>" />
                                <p class="text-danger small"><?php echo isset($errores['nombre']) ? $errores['nombre'] : '';?></p>
                            </div>
                        </div>  
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Contraseña:</label>
                                <input type="password" class="form-control" name="pass" id="pass" value="<?php echo isset($input['pass']) ? $input['pass'] : '';?>" />
                                <p class="text-danger small"><?php echo isset($errores['pass']) ? $errores['pass'] : '';?></p>
                            </div>
                        </div>  
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Roles:</label>
                                <select name="roles[]" id="roles" class="form-control select2" data-placeholder="Roles">
                                    <option value="">-</option>
                                    <?php
                                    foreach ($roles as $rol) {
                                        ?>
                                        <option value="<?php echo $rol['id_rol']; ?>" <?php echo (isset($_GET['roles']) && in_array($rol['id_rol'], $_GET['roles'])) ? 'selected' : ''; ?>><?php echo $rol['id_rol']." - ".ucfirst($rol['rol']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                 <p class="text-danger small"><?php echo isset($errores['roles']) ? $errores['roles'] : '';?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">                     
                        <a href="/usuarios_sistema" value="" name="reiniciar" class="btn btn-info">Volver</a>
                        <input type="submit" value="Añadir Producto" class="btn btn-primary ml-2"/>
                    </div>
                </div>
               
            </form>
        </div>
    </div>                      
</div>
