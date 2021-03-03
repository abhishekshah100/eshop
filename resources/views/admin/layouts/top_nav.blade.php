<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-users"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{ route('show-url') }}" class="dropdown-item">
            <i class="fas fa-cogs"></i> Settings
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin-logout') }}" class="dropdown-item">
           <i class="fas fa-sign-out-alt"></i> Log Out
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->