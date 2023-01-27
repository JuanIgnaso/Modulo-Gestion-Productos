<div class="row">       
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
            <form method="get"  action="/usuarios">
                <input type="hidden" name="order" value="<?php echo (isset($_GET['order']) && filter_var($_GET['order'], FILTER_VALIDATE_INT)) ? $_GET['order'] : ''; ?>"/>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>   
                </div> 
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <select name="rol[]" id="rol" class="form-control select2" data-placeholder="Roles"  multiple>
                                    <option value="">-</option>
                                    <?php
                                    foreach ($roles as $rol) {
                                        ?>
                                        <option value="<?php echo $rol['ID_rol']; ?>" <?php echo (isset($_GET['rol']) && in_array($rol['ID_rol'], $_GET['rol'])) ? 'selected' : ''; ?>><?php echo ucfirst($rol['nombre_rol']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="username">Nombre usuario:</label>
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($input['username']) ? $input['username'] : ''; ?>" />
                            </div>
                        </div>   
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="salarioBruto">Salario Bruto:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="min_salario" id="min_salario" value="<?php echo isset($input['min_salario']) ? $input['min_salario'] : ''; ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="max_salario" id="max_salario" value="<?php echo isset($input['max_salario']) ? $input['max_salario'] : ''; ?>" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="retencion">Retención:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="min_retencion" id="min_retencion" value="<?php echo isset($input['min_retencion']) ? $input['min_retencion'] : ''; ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="max_retencion" id="max_retencion" value="<?php echo isset($input['max_retencion']) ? $input['max_retencion'] : ''; ?>" placeholder="Máximo" />
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
                if(count($usuarios)  >  0){                                    
                ?>
                <!--<form action="./?sec=formulario" method="post">     -->
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <th><a href="/usuarios?order=1">Nombre Usuario</a></th>
                            <th><a href="/usuarios?order=2">Rol</a></th>
                            <th><a href="/usuarios?order=3">Salario Bruto</a></th>
                            <th><a href="/usuarios?order=4">Retencion IRPF</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                    
                            foreach($usuarios as $usuario){
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
