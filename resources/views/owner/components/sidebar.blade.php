<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Project Cepat</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">RB</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Management
                        Sales</span></a>
                <ul class="dropdown-menu">
                    <li class=''>
                        <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                    </li>
                    <li class=''>
                        <a class="nav-link" href="{{ route('outlets.index') }}">Outlets</a>
                    </li>
                    <li class=''>
                        <a class="nav-link" href="{{ route('checkins.index') }}">CheckIn Sales</a>
                    </li>
                    <li class=''>
                        <a class="nav-link" href="{{ route('salesPiutang.index') }}">Piutang Sales</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Management
                        Kolektor</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li>

                </ul>
                <ul class="dropdown-menu">
                    <li class=''>
                        <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                    </li>
                    <li class=''>
                        <a class="nav-link" href="{{ route('outlets.index') }}">Outlets</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Management
                        Inputer</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li>

                </ul>
                <ul class="dropdown-menu">
                    <li class=''>
                        <a class="nav-link" href="{{ route('orders.index') }}">Order</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Management
                        Gudang</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li>

                </ul>
          
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Management
                        Marketing</span></a>
                <ul class="dropdown-menu">
                    <li class=''>
                        <a class="nav-link" href="{{ route('stock.index') }}">Stock</a>
                    </li>
                    <li class=''>
                        <a class="nav-link" href="{{ route('dataOtlet.index') }}">Data Otlet</a>
                    </li>
                </ul>
            </li>
</div>
