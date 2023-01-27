<!-- Filtrar por Codigo, proveedor, categoria -->
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
            <form method="get"  action="/productos">
                <!-- INPUT HIDDEN -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>   
                </div> 
                
                <div class="card-body">
                    <div class="row flex-row align-items-center justify-content-center">
                        <div class="col-12 col-lg-3">
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
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Codigo:</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" value="<?php echo isset($input['codigo']) ? $input['codigo'] : '';?>" />
                            </div>
                        </div> 
                          <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Proveedores:</label>
                                <select name="categoria[]" id="proveedor" class="form-control select2" data-placeholder="Roles"  multiple>
                                    <option value="">-</option>
                                    <?php
                                    foreach ($categorias as $categoria) {
                                        ?>
                                        <option value="<?php echo $categoria['id_categoria']; ?>" <?php echo (isset($_GET['categoria']) && in_array($categoria['cif'], $_GET['categoria'])) ? 'selected' : ''; ?>><?php echo $categoria['id_categoria']." - ".ucfirst($categoria['nombre_categoria']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">                     
                        <a href="/productos" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
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
                <h6 class="m-0 font-weight-bold text-primary">Datos de los Productos</h6>
                <h6>Total de registros: <b class="text-danger"><?php echo count($productos);?></b></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                
                <?php
                if(count($productos) > 0){
                ?>
                <!-- if(count($elemento) >0 -->

                <!--<form action="./?sec=formulario" method="post">     -->
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <!-- Aqui se ponen los campos a pelo
                                    código, nombre, proveedor, categoría, stock y PVP 
                            -->
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Proveedor</th>
                            <th>Categoría</th>
                            <th>stock</th>
                                   
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($productos as $producto){
                        ?>
                        <tr>
                            <td><?php echo $producto['codigo']?></td>
                            <td><?php echo $producto['nombre']?></td>
                            <td><?php echo $producto['proveedor']?></td>
                            <td><?php echo $producto['nombre_categoria']?></td>
                            <td><?php echo $producto['stock']?></td>

                        </tr>
                        <?php
                        }
                        ?>
                        <!-- Se implantara el foreach cuando se tenga preparado la consulta para 
                        mostrar todo
                        <?php
                        /*foreach($usuarios as $usuario)*/
                        ?>
                            <tr>
                                    <td> echo $usuario['campo']
                                    ....
                        </tr>
                        <?php
                      /* }
                        echo tr
                        */?>
                       
                        -->
                       
                    </tbody>           
                </table>
                
                <?php
                }else{
                ?>
                <p class="text-danger">No Se Han Encontrado Datos</p>
                <?php
                }
                ?>
                <!-- 
                }
                   else{
                p class No existen registros
                -->
                
            </div>
        </div>
    </div>                        
</div>