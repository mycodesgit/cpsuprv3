@php
    $current_route=request()->route()->getName();

    $dashActive = in_array($current_route, ['dashboard']) ? 'active' : '';   
    $manageActive = in_array($current_route, ['categoryRead']) ? 'active' : '';   
    $pendingAllActive = in_array($current_route, ['pendingAllListRead', 'pendingAllListView']) ? 'active' : '';
@endphp

<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index-2.html" class="text-white">
            <img src="{{ asset('template/assets/img/cpsulogov4.png') }}" alt="" width="28%" style="padding-top: 10px !important; padding-bottom: 10px !important; padding-right: 10px !important; margin-left: -15px !important"> 
        </a>
        <span class="text-white" style="margin-left: -10px; font-size: 12pt">Purchase Request</span>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index-2.html" class="text-white">PR</a>
    </div>
    <ul class="sidebar-menu mt-4">
        <li class="menu-header" style="border-color: #3a7d5c">Main Navigation</li>

        <li class="{{ $dashActive }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-border-all"></i> <span>Dashboard</span>
            </a>
        </li>

        @if(Auth::user()->role=='Administrator' || Auth::user()->role=='Procurement Officer' || Auth::user()->role=='Checker')
            <li class="{{ $manageActive }}">
                <a class="nav-link" href="{{ route('categoryRead') }}">
                    <i class="fas fa-bars-progress"></i> <span>Manage</span>
                </a>
            </li>
        @endif

        <li class="{{ $pendingAllActive }}">
            <a class="nav-link" href="{{ route('pendingAllListRead') }}">
                <i class="fas fa-clock"></i> <span>Pending PR</span>
            </a>
        </li>

        <li>
            <a class="nav-link" href="#">
                <i class="fas fa-thumbs-up"></i> <span>Approved PR</span>
            </a>
        </li>

        <li>
            <a class="nav-link" href="#">
                <i class="fas fa-book"></i> <span>PPMP</span>
            </a>
        </li>

        <li class="menu-header" style="border-top: none">Reports Navigation</li>

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-file"></i> <span>Reports</span></a>
            <ul class="dropdown-menu" style="display: none;">
                <li><a href="">Consolidation 1</a></li> 
                <li><a href="">Consolidation 2</a></li> 
            </ul>
        </li>

        <li class="menu-header" style="border-top: none">Users Navigation</li>

        <li>
            <a class="nav-link" href="#">
                <i class="fas fa-users"></i> <span>Users</span>
            </a>
        </li>
    </ul>
    <div class="mt-4 mb-4 p-3 hide-sidebar-mini sidebar-transition" style="position: fixed; bottom: 20px; width: 13%; z-index: 999;">
        <a href="https://getcodiepie.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split"><i class="fas fa-rocket"></i> Documentation</a>
    </div>
</aside>