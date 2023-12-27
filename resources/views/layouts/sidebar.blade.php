 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">
        AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

       <!-- Sidebar Menu -->
       <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
        </ul>

        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="login.php" class="nav-link">
              
            
              </p>
            </a>
           </li>
            </ul>
        
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('students.index')}}" class="nav-link">
              <p>
                <i class="fa-solid fa-users fa-beat-fade"></i>
             Users
              </p>
            </a>
           </li>
            </ul>

            
           <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('brands.index')}}" class="nav-link">
              <p><i class="fa-solid fa-bandage"></i>
                Brands
              </p>
            </a>
           </li>
            </ul>

            <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('categories.index')}}" class="nav-link">
              <p><i class="fa-solid fa-list fa-beat-fade"></i>
                Categories
              </p>
            </a>
           </li>
            </ul>


            <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('products.index')}}" class="nav-link">
              <p>
              <i class="fa-solid fa-cart-shopping fa-flip"></i>
                Products
              </p>
            </a>
           </li>
            </ul>


            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('orders.index')}}"class="nav-link">
                  <p>
                    <i class="fa-solid fa-arrow-down-wide-short"></i>
                    Orders
                  </p>
                </a>
               </li>
                </ul>


                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('orders.details')}}" class="nav-link">
                      <p>
                      <i class="fa-solid fa-sort"></i>
                        Orders Details
                      </p>
                    </a>
                   </li>
                    </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>