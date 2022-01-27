  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{route('userlist')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               User 
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('configlist')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
               Configuration 
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('bannerlist')}}" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Banner 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('categorylist')}}" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Category 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('ProductList')}}" class="nav-link">
            <i class="fa fa-list" aria-hidden="true"></i>
              <p>
                Product 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('CouponList')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Coupon 
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{route('ContactUs')}}" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
               Contact Us
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('DisplayCMS')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              CMS
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('Orders')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Order 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('report')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Reports 
              </p>
            </a>
          </li>
         
         
        
       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>