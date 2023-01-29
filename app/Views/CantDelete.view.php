
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get"  action="/cantDelete">
                <!-- INPUT HIDDEN -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>   
                </div> 
                
                <div class="card-body">
                    <div class="col-12 alert alert-danger">
                        <p><?php echo $mensaje;?></p>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">                     
                        <a href="/productos" value="" name="volver" class="btn btn-info">Volver</a>
                    </div>
                </div>
               
            </form>
        </div>
    </div>           
</div>