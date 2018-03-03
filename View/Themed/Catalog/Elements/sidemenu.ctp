      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?=$this->Html->url(array('controller' => 'home', 'action' => 'index'))?>">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bilete">
          <a class="nav-link" href="<?=$this->Html->url(array('controller' => 'tickets', 'action' => 'index'))?>">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Bilete</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Formular">
          <a class="nav-link" href="<?=$this->Html->url(array('controller' => 'intrebari', 'action' => 'index'))?>">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Formular</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Definitii limbi traduceri">
          <a class="nav-link" href="<?=$this->Html->url(array('controller' => 'languages', 'action' => 'index'))?>">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Definitii limbi traduceri</span>
          </a>
        </li>

       
        

      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>