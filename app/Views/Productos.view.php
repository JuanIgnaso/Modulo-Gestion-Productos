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
                 <input type="hidden" name="order" value="<?php echo (isset($_GET['order']) && filter_var($_GET['order'], FILTER_VALIDATE_INT)) ? $_GET['order'] : ''; ?>"/>
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
                                <label for="username">Categoria:</label>
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
            <div class="card-body text-center">
                 <a href="/addProducto" name="anadir" class="btn btn-primary">Añadir Nuevo Registro</a>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Datos de los Productos</h6>
                <h6>Total de registros: <b class="text-danger"><?php echo $productos_totales;?></b></h6>
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
                           Permitir ordenación por código, nombre, proveedor, categoría y stock.
                            -->
                            <th><a href="/productos?order=1<?php echo $queryString;?>">Codigo</a></th>
                            <th><a href="/productos?order=2<?php echo $queryString;?>">Nombre</a></th>
                            <th><a href="/productos?order=3<?php echo $queryString;?>">Proveedor</a></th>
                            <th><a href="/productos?order=4<?php echo $queryString;?>">Categoría</a></th>
                            <th><a href="/productos?order=5<?php echo $queryString;?>">Stock</a></th>
                            <th>PVP</th>
                                   
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
                            <td><?php echo $producto['coste'] * $producto['margen'] * (1 + $producto['iva'] / 100);?></td>
                             <!-- (coste x margen x (1 + iva/ 100) -->
                            <td>
                                <!-- BORRAR /proveedor/delete/< ? php echo $proveedor['cif'];? >-->
                            <a href="" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></a>
                            <!-- EDITAR /proveedor/edit/< ? php echo $proveedor['cif']; ? > -->
                            <a href="" class="btn btn-info ml-1"><i class="fas fa-pen"></i></a>
                            </td>
                           

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
              <div class="card-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                        if($paginaActual > 1){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="/productos?page=1<?php echo $queryPage; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">First</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="/productos?page=<?php echo $paginaActual - 1; ?><?php echo $queryPage; ?>" aria-label="Previous">
                                <span aria-hidden="true">&lt;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php
                        }
                        ?>                        
                        <li class="page-item active"><a class="page-link" href="#"><?php echo $paginaActual; ?></a></li>   
                        <?php
                        if($paginaActual < $numPaginas){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="/productos?page=<?php echo $paginaActual + 1; ?><?php echo $queryPage; ?>" aria-label="Next">
                                <span aria-hidden="true">&gt;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="/productos?page=<?php echo $numPaginas; ?><?php echo $queryPage; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Last</span>
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>                        
</div>