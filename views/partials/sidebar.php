<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">

      <ul class="nav nav-warning">
        <li class="nav-item">
          <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
            <i class="fas fa-home"></i>
            <p>Inicio</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="dashboard">
            <ul class="nav nav-collapse">
              <li>
                <a href="demo1/index.html">
                  <span class="sub-item">Dashboard 1</span>
                </a>
              </li>
              <li>
                <a href="demo2/index.html">
                  <span class="sub-item">Dashboard 2</span>
                </a>
              </li>
            </ul>
          </div>
        </li>


        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Modulos</h4>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#base">
            <i class="fas fa-layer-group"></i>
            <p>Caso</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="base">
            <ul class="nav nav-collapse">
              <li>
                <a href="<?=getUrl("Caso","Caso","getCreate"); ?>">
                  <span class="sub-item">Registrar caso</span>
                </a>
              </li>
              <li>
                <a href="components/buttons.html">
                  <span class="sub-item">Consultar caso</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#sidebarLayouts">
            <i class="fas fa-th-list"></i>
            <p>Orden de mantenimiento</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayouts">
            <ul class="nav nav-collapse">
              <li>
                <a href="sidebar-style-1.html">
                  <span class="sub-item">Registrar orden</span>
                </a>
              </li>
              <li>
                <a href="overlay-sidebar.html">
                  <span class="sub-item">Consultar orden</span>
                </a>
              </li>

            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#forms">
            <i class="fas fa-directions"></i>
            <p>Tramo</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="forms">
            <ul class="nav nav-collapse">
              <li>
                <a href="forms/forms.html">
                  <span class="sub-item">Registrar tramo</span>
                </a>
              </li>
              <li>
                <a href="forms/forms.html">
                  <span class="sub-item">Consultar tramo</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#tables">
            <i class="fas fa-user"></i>
            <p>Usuario</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="tables">
            <ul class="nav nav-collapse">
              <li>
                <a href="tables/tables.html">
                  <span class="sub-item">Registrar usuario</span>
                </a>
              </li>
              <li>
                <a href="tables/datatables.html">
                  <span class="sub-item">Consultar usuario</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#maps">
            <i class="fas fa-map-marker-alt"></i>
            <p>Geovisor</p>
            <span class="caret"></span>
          </a>
        </li>
        <li class="nav-item">
          <a data-toggle="collapse" href="#submenu">
            <i class="fas fa-cogs"></i>
            <p>Panel de control</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="submenu">
            <ul class="nav nav-collapse">

              <li>
                <a href="<?=getUrl("Barrio","Barrio","index")?>">
                  <span class="sub-item">Consultar barrio</span>
                </a>
              </li>
              <li>
                <a href="<?=getUrl("Comuna","Comuna","index")?>">
                  <span class="sub-item">Consultar comuna</span>
                </a>
              </li>
              <li>
                <a href="<?=getUrl("Deterioro","Deterioro","index")?>">
                  <span class="sub-item">Consultar deterioro</span>
                </a>
              </li>
              <li>
                <a href="<?=getUrl("Elemento","Elemento","index") ?>">
                  <span class="sub-item">Consultar elemento complementario</span>
                </a>
              <li>
                <a href="<?=getUrl("Entorno","Entorno","index")?>">
                  <span class="sub-item">Consultar entorno</span>
                </a>
              </li>
              <li>
                <a href="<?=getUrl("Rol","Rol","index")?>">
                  <span class="sub-item">Consultar rol</span>
                </a>
              </li>
              <li>
                <a href="<?=getUrl("TipoPavimento","TipoPavimento","index") ?>">
                  <span class="sub-item">Consultar pavimento</span>
                </a>
              </li>

            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->
