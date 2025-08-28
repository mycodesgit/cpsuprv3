@php
    $current_route=request()->route()->getName();

    $dashActive = in_array($current_route, ['dashboard']) ? 'active' : '';   
    $manageActive = in_array($current_route, ['categoryRead']) ? 'active' : '';   
    $pendingAllActive = in_array($current_route, ['pendingAllListRead', 'pendingTechCheckListRead', 'pendingAllListView']) ? 'active' : '';
    $approvedAllActive = in_array($current_route, ['approvedListAllRead']) ? 'active' : '';
    $ppmpsActive = in_array($current_route, ['ppmpRead']) ? 'active' : '';
    $gensActive = in_array($current_route, ['genSearch']) ? 'active' : '';
    $reportsActive = in_array($current_route, ['consolidateRead', 'consolidateForm2Read']) ? 'active' : '';
    $usersAllActive = in_array($current_route, ['userRead']) ? 'active' : '';

    $shopUserActive = in_array($current_route, ['shoplistRead']) ? 'active' : '';
    $cartUserActive = in_array($current_route, ['prPurposeRequest', 'selectItems']) ? 'active' : '';
    $pendingUserActive = in_array($current_route, ['pendingListRead', 'pendingAllListView']) ? 'active' : '';
    $approvedUserActive = in_array($current_route, ['approvedListRead']) ? 'active' : '';
    $returnUserActive = in_array($current_route, ['returnedUserListRead', 'editreturnselectItems']) ? 'active' : '';
    $canceledUserActive = in_array($current_route, ['cancelUserListRead']) ? 'active' : '';
    $crtepapspreUserActive = in_array($current_route, ['papsYearRead', 'viewlistpapspre']) ? 'active' : '';
    $crteppmpUserActive = in_array($current_route, ['ppmpYearRead', 'viewlistppmp']) ? 'active' : '';

    $pendingBudAllActive = in_array($current_route, ['pendingAllBudgetListRead', 'pendingAllListView']) ? 'active' : '';
    $pendingBudCancelAllActive = in_array($current_route, ['requestPRcancelBudgetListRead', 'pendingAllListView']) ? 'active' : '';
    $approvedBudAllActive = in_array($current_route, ['approvedListBudAllRead']) ? 'active' : '';
@endphp

<style>
    #sidebar-wrapper:hover {
        overflow: hidden !important;
    }
    /* Hide balance when sidebar is collapsed */
    .sidebar-collapse .balance-box {
        display: none !important;
    }
</style>

<aside id="sidebar-wrapper" style="overflow-x: hidden;">
    <div class="sidebar-brand">
        <a href="index-2.html" class="text-white">
            <img src="{{ asset('template/assets/img/cpsulogov4.png') }}" alt="" width="28%" style="padding-top: 10px !important; padding-bottom: 10px !important; padding-right: 10px !important; margin-left: -15px !important"> 
        </a>
        <span class="text-white" style="margin-left: -10px; font-size: 12pt">Purchase Request</span>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index-2.html" class="text-white">PR</a>
    </div>
    <hr>
    <div class="form-inline balance-box" style="padding-left: 20px !important; padding-right: 20px !important">
        <div class="input-group" data-widget="sidebar-search">
            <div class="input-group-append">
                <span class="input-group-text" style="background-color: #3a7d5c; border-color: #3a7d5c; color: white;">
                    <i class="fas fa-peso-sign"></i>
                </span>
            </div>
            <input class="form-control form-control-sidebar" type="text" placeholder="Balance" value="0.00" aria-label="Search" style="background-color: #3a7d5c; border-color: #3a7d5c; color: white;" readonly>
        </div>
    </div>
    <ul class="sidebar-menu mt-4">
        <li class="menu-header" style="border-color: #3a7d5c">Main Navigation</li>

        <li class="{{ $dashActive }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-border-all"></i> <span>Dashboard</span>
            </a>
        </li>

        @if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'Checker')
            <li class="{{ $manageActive }}">
                <a class="nav-link" href="{{ route('categoryRead') }}">
                    <i class="fas fa-bars-progress"></i> <span>Manage</span>
                </a>
            </li>
        

            <li class="{{ $pendingAllActive }}">
                <a class="nav-link" href="{{ route('pendingAllListRead') }}">
                    <i class="fas fa-clock"></i> <span>Pending PR</span>
                    <span id="pendingCount" class="badge badge-warning" style="font-size: 10pt; width: 30px; height: 20px; line-height: 10px; text-align: left !important;">
                        {{ $data['pendCount'] }}
                    </span>
                </a>
            </li>

            <li class="{{ $approvedAllActive }}">
                <a class="nav-link" href="{{ route('approvedListAllRead') }}">
                    <i class="fas fa-thumbs-up"></i> <span>Approved PR</span>
                </a>
            </li>

            <li class="{{ $ppmpsActive }}">
                <a class="nav-link" href="{{ route('ppmpRead') }}">
                    <i class="fas fa-book"></i> <span>PPMP</span>
                </a>
            </li>

            <li class="{{ $gensActive }}">
                <a class="nav-link" href="{{ route('genSearch') }}">
                    <i class="fas fa-search"></i> <span>Search</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->role == 'MIS Checker')
            <li class="{{ $pendingAllActive }}">
                <a class="nav-link" href="{{ route('pendingTechCheckListRead') }}">
                    <i class="fas fa-clock"></i> <span>Pending PR</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->role !='Administrator' && Auth::user()->role !='Procurement Officer' && Auth::user()->role !='Checker' && Auth::user()->role !='Budget Officer' && Auth::user()->role !='MIS Checker')
            <li class="{{ $shopUserActive }}">
                <a class="nav-link" href="{{ route('shoplistRead') }}">
                    <i class="fas fa-cart-plus"></i> <span>Shop Item</span>
                </a>
            </li>

            <li class="{{ $cartUserActive }}">
                <a class="nav-link" href="{{ route('prPurposeRequest') }}">
                    <i class="fas fa-cart-shopping"></i> <span>My Cart</span>
                </a>
            </li>

            <li class="{{ $pendingUserActive }}">
                <a class="nav-link" href="{{ route('pendingListRead') }}">
                    <i class="fas fa-clock"></i> <span>Pending PR</span>
                    <span id="pendingUserCount" class="badge badge-warning" style="font-size: 10pt; width: 30px; height: 20px; line-height: 10px; text-align: left !important;">
                        {{ $data['pendUserCount'] }}
                    </span>
                </a>
            </li>

            <li class="{{ $approvedUserActive }}">
                <a class="nav-link" href="{{ route('approvedListRead') }}">
                    <i class="fas fa-thumbs-up"></i> <span>Approved PR</span>
                    <span id="approvedUserCount" class="badge badge-warning" style="font-size: 10pt; width: 30px; height: 20px; line-height: 10px; text-align: left !important;">
                        {{ $data['approvedUserCount'] }}
                    </span>
                </a>
            </li>

            <li class="{{ $returnUserActive }}">
                <a class="nav-link" href="{{ route('returnedUserListRead') }}">
                    <i class="fas fa-right-left"></i> <span>Returned PR</span>
                    <span id="returnedUserCount" class="badge badge-warning" style="font-size: 10pt; width: 30px; height: 20px; line-height: 10px;">
                        {{ $data['returnedUserCount'] }}
                    </span>
                </a>
            </li>

            <li class="{{ $canceledUserActive }}">
                <a class="nav-link" href="{{ route('cancelUserListRead') }}">
                    <i class="fas fa-ban"></i> <span>Cancelled PR</span>
                </a>
            </li>

            <li class="menu-header" style="border-top: none">PAP's PRE Creation</li>
            <li class="{{ $crtepapspreUserActive }}">
                <a class="nav-link" href="{{ route('papsYearRead') }}">
                    <i class="far fa-file-excel"></i> <span>Create PAP's</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'Budget Officer')
            <li class="menu-header" style="border-top: none">Approval Navigation</li>
            <li class="{{ $pendingBudAllActive }}">
                <a class="nav-link" href="{{ route('pendingAllBudgetListRead') }}">
                    <i class="fas fa-clock"></i> <span>Waiting PR</span>
                    <span id="pendingBudCount" class="badge badge-warning" style="font-size: 10pt; width: 43px; height: 20px; line-height: 10px;">
                        {{ $data['pendBudCount'] }}
                    </span>
                </a>
            </li>

            <li class="{{ $pendingBudCancelAllActive }}">
                <a class="nav-link" href="{{ route('requestPRcancelBudgetListRead') }}">
                    <i class="fas fa-ban"></i> <span>Cancel PR</span>
                </a>
            </li>

            <li class="menu-header" style="border-top: none">Reports Navigation</li>
            <li class="{{ $approvedBudAllActive }}">
                <a class="nav-link" href="{{ route('approvedListBudAllRead') }}">
                    <i class="fas fa-check"></i> <span>Approved PR</span>
                    {{-- <span id="pendingBudCount" class="badge badge-warning" style="font-size: 10pt; width: 43px; height: 20px; line-height: 10px; z-index: 999 !important;">
                        {{ $data['pendBudCount'] }}
                    </span> --}}
                </a>
            </li>
            <li class="">
                <a class="nav-link" href="#">
                    <i class="fas fa-times"></i> <span>Canceled PR</span>
                </a>
            </li>
        @endif
        
        @if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'Procurement Officer' || Auth::user()->role =='Checker')
            <li class="menu-header" style="border-top: none">Reports Navigation</li>

            <li class="dropdown active {{ $reportsActive ? 'active menu-open' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file"></i> <span>Reports</span></a>
                <ul class="dropdown-menu" style="display: none; background-color: none !important">
                    <li class="{{ $reportsActive }}"><a href="{{ route('consolidateRead') }}" style="background-color: transparent">Consolidation 1</a></li> 
                    <li><a href="{{ route('consolidateForm2Read') }}" style="background-color: transparent">Consolidation 2</a></li> 
                </ul>
            </li>
        @endif

        @if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'Checker')
            <li class="menu-header" style="border-top: none">Users Navigation</li>

            <li class="{{ $usersAllActive }}">
                <a class="nav-link" href="{{ route('userRead') }}">
                    <i class="fas fa-users"></i> <span>Users</span>
                </a>
            </li>
        @endif
    </ul>

    {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini sidebar-transition logout-button-container" style="position: absolute; bottom: 20px; width: 100%; z-index: 999;">
        <a href="{{ route('logout') }}" class="btn btn-primary btn-lg btn-block btn-icon-split text-left">
            <i class="far fa-file-excel"></i> <span style="padding-left: 15px">CREATE PPMP</span>
        </a>
    </div> --}}
</aside>

<script>
    var allPendingCountRoute = "{{ route('pendingAllListRead') }}";
    var allPendingBudgetCountRoute = "{{ route('pendingAllBudgetListRead') }}";
    var userPendingCountRoute = "{{ route('pendingListRead') }}";
    var allApprovedCountRoute = "{{ route('approvedListAllRead') }}";
    var userApprovedCountRoute = "{{ route('approvedListRead') }}";
    var allReturnedCountRoute = "{{ route('returnedAllListRead') }}";
    var userReturnedCountRoute = "{{ route('returnedUserListRead') }}";
</script>
{{-- <script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body',
            placement: 'right'
        });
    });
</script> --}}
