<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Inicio
              </p>
            </a>
          </li> 
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-csv"></i>
              <p>
                CSV
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/csv/historico" class="nav-link <?php echo isset($seccion) && $seccion === '/csv/historico' ? 'active' : ''; ?>">
                  <i class="fas fa-history nav-icon"></i>
                  
                  <p>Histórico</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/csv/grupos-edad" class="nav-link <?php echo isset($seccion) && $seccion === '/csv/grupos-edad' ? 'active' : ''; ?>">
                  <i class="fas fa-restroom nav-icon"></i>
                  <p>Grupos Edad</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/csv/totales-2020" class="nav-link <?php echo isset($seccion) && $seccion === '/csv/totales-2020' ? 'active' : ''; ?>">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Totales 2020</p>
                </a>
              </li>
            </ul>
          </li>   
          
                    <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="fas fa-database"></i>
              <p>
                BBDD
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/usuarios" class="nav-link <?php echo isset($seccion) && $seccion === '/usuarios' ? 'active' : ''; ?>">
                  <i class="fas fa-users"></i>
                  <p>Todos Los Usuarios</p>
                </a>
              </li>
       <?php
           if(isset($_SESSION['user']) && preg_match('/rwd/',$_SESSION['permisos']['productos'])){

       ?>       
                <li class="nav-item">
                <a href="/productos" class="nav-link <?php echo isset($seccion) && $seccion === '/csv/totales-2020' ? 'active' : ''; ?>">
                 <i class="fas fa-mobile-alt"></i>
                  <p>Productos</p>
                </a>
              </li>
              
              <?php
                }
              ?>
              
                 <?php
           if(isset($_SESSION['user']) && preg_match('/rwd/',$_SESSION['permisos']['proveedores'])){

                ?>     
               <li class="nav-item">
                <a href="/proveedores" class="nav-link <?php echo isset($seccion) && $seccion === '/csv/totales-2020' ? 'active' : ''; ?>">
                <i class="fas fa-truck"></i>
                  <p>Proveedores</p>
                </a>
              </li>
            <?php
                }
              ?>
              
          <?php
           if(isset($_SESSION['user']) && preg_match('/rwd/',$_SESSION['permisos']['categorias'])){
         ?>  
               <li class="nav-item">
                <a href="/categorias" class="nav-link <?php echo isset($seccion) && $seccion === '/csv/totales-2020' ? 'active' : ''; ?>">
                <i class="fab fa-hackerrank"></i>
                  <p>Categorias</p>
                </a>
              </li>
         <?php
           }
         ?>     
              
              
            </ul>
          </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->