<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="text-nowrap logo-img d-flex text-primary mt-2">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="28"  height="28"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                <h3 class="px-2 text-primary">SimpleLink</h3>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>
                @if (Auth::user()->role != 'admin')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}" aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @else
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('/admin/dashboard') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}" aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('admin/shortened-link') ? 'active' : '' }}" href="{{ url('admin/shortened-link') }}" aria-expanded="false">
                        <iconify-icon icon="solar:link-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Shortened Link</span>
                    </a>
                </li>                
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('admin/userman') ? 'active' : '' }}" href="{{ url('/admin/userman') }}" aria-expanded="false">
                        <iconify-icon icon="solar:user-id-linear"></iconify-icon>
                        <span class="hide-menu">User Manager</span>
                    </a>
                </li>                
                @endif
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
        </nav>
    </div>
</aside>
