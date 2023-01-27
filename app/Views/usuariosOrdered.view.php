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
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Datos del CSV</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <?php 
                if(count($usuarios) > 0){                                    
                ?>
                <!--<form action="./?sec=formulario" method="post">                   -->
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <th>Nombre Usuario</th>
                            <th>Rol</th>
                            <th>Salario Bruto</th>
                            <th>Retencion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                    
                            foreach($usuarios as $usuario){
                            ?>
                        <tr>
                                <td><?php echo $usuario['username']; ?></td>
                                <td><?php echo $usuario['rol']?></td>
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
