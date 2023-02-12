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
            <form method="get"  action="/proveedores">
                <!-- INPUT HIDDEN -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>   
                </div> 
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">CIF:</label>
                                <input type="text" class="form-control" name="cif" id="cif" value="<?php echo isset($input['cif']) ? $input['cif'] : '';?>" />
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
                                <label for="username">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo isset($input['nombre']) ? $input['nombre'] : '';?>" />
                            </div>
                        </div>  
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">País:</label>
                                <input type="text" class="form-control" name="pais" id="pais" value="<?php echo isset($input['pais']) ? $input['pais'] : '';?>" />
                            </div>
                        </div>  
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Correo:</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo isset($input['email']) ? $input['email'] : '';?>" />
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">                     
                        <a href="/proveedores" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
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
        
                <div class="text-center">
                      <a href="" name="anadir" class="btn btn-info">Añadir Nuevo Registro</a>
                </div>

                <div id="button_container" class="mb-3"></div>
                
                <?php
                if(count($proveedores) > 0){
                ?>
                <!-- if(count($elemento) >0 -->

                <!--<form action="./?sec=formulario" method="post">     -->
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <!-- Aqui se ponen los campos a pelo
                            th a /ruta?order=1 echo $queryString 
                            -->
                            <th><a href="/proveedores?order=1">CIF</a></th>
                            <th><a href="/proveedores?order=2">Código</a></th>
                            <th><a href="/proveedores?order=3">Nombre</a></th>
                            <th><a href="/proveedores?order=4">WebSite</a></th>
                            <th><a href="/proveedores?order=5">Email</a></th>              
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($proveedores as $proveedor){
                        ?>
                        <tr>
                            <td><?php echo $proveedor['cif']?></td>
                            <td><?php echo $proveedor['codigo']?></td>
                            <td><?php echo $proveedor['nombre']?></td>
                            <td><?php echo $proveedor['website']?></td>
                            <td><?php echo $proveedor['email']?></td>
                            
                         <?php
                         if(isset($_SESSION['user']) && preg_match("/rw/",$_SESSION['permisos']['proveedores'])){
                         ?>                           
                            <td>
                         <?php
                         if(isset($_SESSION['user']) && preg_match("/rwd/",$_SESSION['permisos']['proveedores'])){
                         ?>
                                <!-- BORRAR -->
                            <a href="/proveedor/delete/<?php echo $proveedor['cif'];?>" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></a>
                         <?php
                           }
                          ?>                           
                            <!-- EDITAR -->
                            <a href="/proveedor/edit/<?php echo $proveedor['cif'];?>" class="btn btn-info ml-1"><i class="fas fa-pen"></i></a>
                            </td>
                           <?php
                           }
                          ?>
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






