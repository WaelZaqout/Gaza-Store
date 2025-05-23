    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
            <div class="sidebar-brand-icon">
                <i class="fas fa-store"></i>
            </div>
            <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('admin.dash') }}</span></a>
        </li>

        <!-- Divider -->

        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Pages Collapse Menu -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
                aria-expanded="true" aria-controls="collapseCategory">
                <i class="fas fa-fw fa-tags"></i>
                <span>{{ __('admin.categories') }}</span>
            </a>
            <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.categories.index') }}">{{ __('admin.all_categories') }}</a>
                    <a class="collapse-item" href="{{ route('admin.categories.create') }}">{{ __('admin.add_new') }}</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Pages Collapse Menu -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
                aria-expanded="true" aria-controls="collapseProducts">
                <i class="fas fa-fw fa-heart"></i>
                <span>{{ __('admin.products') }}</span>
            </a>
            <div id="collapseProducts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.products.index') }}">{{ __('admin.all_products') }}</a>
                    <a class="collapse-item" href="{{ route('admin.products.create') }}">{{ __('admin.add_new') }}</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSliders"
                aria-expanded="true" aria-controls="collapseProducts">
               <i class="fas fa-closed-captioning"></i>
                <span>{{ __('admin.sliders') }}</span>
            </a>
            <div id="collapseSliders" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.silders.index') }}">{{ __('admin.all_sliders') }}</a>
                    <a class="collapse-item" href="{{ route('admin.silders.create') }}">{{ __('admin.add_new') }}</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider my-0">


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>{{ __('admin.order') }}</span></a>
        </li>

        <hr class="sidebar-divider my-0">


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.customers.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>{{ __('admin.coustomer') }}</span></a>
        </li>
        <hr class="sidebar-divider my-0">



        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.invoices.index') }}">
               <i class="fas fa-closed-captioning"></i>
                <span>{{ __('admin.invoices') }}</span>
            </a>
        </li>


        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.payments.index') }}">
                <i class="fas fa-fw fa-dollar-sign"></i>
                <span>{{ __('admin.payments') }}</span></a>
        </li>

        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Pages Collapse Menu -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoles"
                aria-expanded="true" aria-controls="collapseRoles">
                <i class="fas fa-fw fa-lock"></i>
                <span>{{ __('admin.role') }}</span>
            </a>
            <div id="collapseRoles" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="buttons.html">{{ __('admin.all_role') }}</a>
                    <a class="collapse-item" href="cards.html">{{ __('admin.add_new') }}</a>
                </div>
            </div>
        </li>



        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
