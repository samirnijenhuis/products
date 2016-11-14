<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $profile_picture }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $short_name }}</p>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Core</li>


            <li class="{{ active_class(if_route(['types.index'])) }}">
                <a href="{{ route('types.index') }}"><i class="fa fa-tachometer"></i> <span>Types</span></a>
            </li>

            <li class="{{ active_class(if_route(['products.index'])) }}">
                <a href="{{ route('products.index') }}"><i class="fa fa-tachometer"></i> <span>Products</span></a>
            </li>



            <!--
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>-->
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>