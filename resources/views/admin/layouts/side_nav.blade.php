<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:#040202">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link"> 
      <span class="brand-text font-weight-light"> <img src="{{ asset('images/logo/led-logo.png')}}"
           alt="ESHOP Logo" style="width:100px; height:60px; margin-left:20px;"></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('view-order') }}" class="nav-link">
                <i class="fas fa-file-invoice"></i>
                  <p>Order</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('view-customer') }}" class="nav-link">
                <i class="fas fa-users"></i>
                  <p>Customer</p>
              </a>
          </li>
      		<li class="nav-item">
      				<a href="{{ route('category.index') }}" class="nav-link">
      					<i class="nav-icon fas fa-th"></i>
      						<p>Category</p>
      				</a>
      		</li>
          <li class="nav-item">
              <a href="{{ route('sub_category.index') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                  <p>Sub Category</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('brand.index') }}" class="nav-link">
                <i class="fas fa-copyright"></i>
                  <p>Brand</p>
              </a>
          </li>
          <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="fab fa-product-hunt"></i>
                    <p>
                      Products
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="{{ route('product.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Product</p>
                          </a>
                    </li>
                    <li class="nav-item">
                          <a href="{{ route('product.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Products</p>
                          </a>
                    </li>
                  </ul>
          </li>
          <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="fab fa-product-hunt"></i>
                    <p>
                      Hot Deal
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="{{ route('admin-hot-deal') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add New Hot Deal Products</p>
                          </a>
                    </li>
                    <li class="nav-item">
                          <a href="{{ route('admin-view-hot-deal') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Hot Deal Products</p>
                          </a>
                    </li>
                  </ul>
          </li>
          <li class="nav-item">
              <a href="{{ url('admin/coupon') }}" class="nav-link">
                <i class="fas fa-copyright"></i>
                  <p>Coupon</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('pincode') }}" class="nav-link">
                <i class="fas fa-copyright"></i>
                  <p>Pincode</p>
              </a>
          </li>
            <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="fab fa-product-hunt"></i>
                    <p>
                     Vendor
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="{{ route('view-vendor') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Vendor</p>
                          </a>
                    </li>
                    <li class="nav-item">
                          <a href="{{ route('request-vendor') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Request Vendor</p>
                          </a>
                    </li>
                    <li class="nav-item">
                          <a href="{{ route('admin-add-vendor') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add New Vendor</p>
                          </a>
                    </li>
                  </ul>
            </li>
            <li class="nav-item">
              <a href="{{ url('admin/contact') }}" class="nav-link">
                <i class="fas fa-copyright"></i>
                  <p>Contact</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin-newsletter') }}" class="nav-link">
                <i class="fas fa-file-invoice"></i>
                  <p>Newsletter</p>
              </a>
          </li>
            <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="fab fa-product-hunt"></i>
                    <p>
                      Settings
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                          <a href="{{ route('frontend-home-ui') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Website UI</p>
                          </a>
                    </li>
                    <li class="nav-item">
                          <a href="{{ route('show-url') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Website Settings</p>
                          </a>
                    </li>
                    <li class="nav-item">
                          <a href="{{ route('other-settings') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Other Settings</p>
                          </a>
                    </li>
                    
                  </ul>
            </li>
        </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>