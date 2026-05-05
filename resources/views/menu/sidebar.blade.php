@php
    $current_route=request()->route()->getName();

    $pendingAllActive = in_array($current_route, ['pendingAllListRead', 'pendingTechCheckListRead', 'pendingAllListView']) ? 'active' : '';
    $approvedAllActive = in_array($current_route, ['approvedListAllRead']) ? 'active' : '';
    $ppmpsActive = in_array($current_route, ['ppmpRead']) ? 'active' : '';
    $gensActive = in_array($current_route, ['genSearch']) ? 'active' : '';
    $archiveActive = in_array($current_route, ['archiveRead', 'archiveShow']) ? 'active' : '';
    $archivedeletedActive = in_array($current_route, ['indexlistdel', 'archiveDeletedShow']) ? 'active' : '';
    $announceActive = in_array($current_route, ['annouceInfo']) ? 'active' : '';
    $reportsActive = in_array($current_route, ['consolidateRead', 'consolidateForm2Read']) ? 'active' : '';
    $usersAllActive = in_array($current_route, ['userRead']) ? 'active' : '';

    $shopUserActive = in_array($current_route, ['shoplistRead']) ? 'active' : '';
    $cartUserActive = in_array($current_route, ['prPurposeRequest', 'selectItems']) ? 'active' : '';
    $pendingUserActive = in_array($current_route, ['pendingListRead', 'pendingAllListView']) ? 'active' : '';
    $approvedUserActive = in_array($current_route, ['approvedListRead']) ? 'active' : '';
    $returnUserActive = in_array($current_route, ['returnedUserListRead', 'editreturnselectItems']) ? 'active' : '';
    $canceledUserActive = in_array($current_route, ['cancelUserListRead']) ? 'active' : '';
    $crtepapspreUserActive = in_array($current_route, ['papsYearRead', 'viewlistpapspre', 'papspreitemsppmp']) ? 'active' : '';
    $crteppmpUserActive = in_array($current_route, ['ppmpYearRead', 'viewlistppmp']) ? 'active' : '';

    $pendingBudAllActive = in_array($current_route, ['pendingAllBudgetListRead', 'pendingAllListView']) ? 'active' : '';
    $pendingBudCancelAllActive = in_array($current_route, ['requestPRcancelBudgetListRead', 'pendingAllListView']) ? 'active' : '';
    $approvedBudAllActive = in_array($current_route, ['approvedListBudAllRead']) ? 'active' : '';
@endphp

@php
    $manageOpen = request()->routeIs('categoryRead', 'unitRead', 'itemRead', 'officeRead', 'yearRead');
@endphp
@php
    $reportOpen = request()->routeIs('consolidateRead', 'consolidateGen_reports', 'consolidateForm2Read', 'consolidateGenform2_reports');
@endphp

<ul class="nav flex-column">
    <li class="px-4 py-2">
        <small class="nav-text text-muted">Main</small>
    </li>
    <li>
        <a class="nav-link {{$current_route=='dashboard'?'active':''}}" href="{{ route('dashboard') }}">
            <i class="ti ti-layout-grid"></i><span class="nav-text">Dashboard</span>
        </a>
    </li>

    @if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'Checker')
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center justify-content-between {{ $manageOpen ? '' : '' }}" data-bs-toggle="collapse" href="#manageMenu" role="button" aria-expanded="false" aria-controls="manageMenu">
                <div class="d-flex align-items-center">
                    <i class="ti ti-server me-2"></i>&nbsp;
                    <span class="nav-text">Manage</span>
                </div>
                <!-- <i class="ti ti-chevron-down"></i> -->
            </a>

            <div class="collapse {{ $manageOpen ? 'show' : '' }}" id="manageMenu">
                <ul class="nav flex-column ms-3 mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('view/category/list*') ? 'active' : '' }}" href="{{ route('categoryRead') }}">
                            <i class="ti ti-box"></i> <span class="nav-text">Category</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('view/unit/list*') ? 'active' : '' }}" href="{{ route('unitRead') }}">
                            <i class="ti ti-file-like"></i> <span class="nav-text">Units</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('view/item/list*') ? 'active' : '' }}" href="{{ route('itemRead') }}">
                            <i class="ti ti-shopping-cart"></i> <span class="nav-text">Items</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('view/office/list*') ? 'active' : '' }}" href="{{ route('officeRead') }}">
                            <i class="ti ti-building"></i> <span class="nav-text">Offices</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('view/year/current/list*') ? 'active' : '' }}" href="{{ route('yearRead') }}">
                            <i class="ti ti-calendar"></i> <span class="nav-text">Years</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        
        <li>
            <a class="nav-link {{$pendingAllActive}}" href="{{ route('pendingAllListRead') }}">
                <i class="ti ti-clock-pin"></i><span class="nav-text">Pending PR</span><span class="badge bg-warning ms-1" id="pendingCount">{{ $data['pendCount'] }}</span>
            </a>
        </li>
        
        <li>
            <a class="nav-link {{$approvedAllActive}}" href="{{ route('approvedListAllRead') }}">
                <i class="ti ti-clock-check"></i><span class="nav-text">Approved PR</span>
            </a>
        </li>
        
        <li>
            <a class="nav-link {{$ppmpsActive}}" href="{{ route('ppmpRead') }}">
                <i class="ti ti-file-horizontal"></i><span class="nav-text">PPMP</span>
            </a>
        </li>

        <li>
            <a class="nav-link {{$announceActive}}" href="{{ route('annouceInfo') }}">
                <i class="ti ti-bell"></i><span class="nav-text">Announcement</span>
            </a>
        </li>
        
        <li>
            <a class="nav-link {{$archiveActive}}" href="{{ route('archiveRead') }}">
                <i class="ti ti-file-zip"></i><span class="nav-text">Archived PR's</span>
            </a>
        </li>

        <li>
            <a class="nav-link {{$archivedeletedActive}}" href="{{ route('indexlistdel') }}">
                <i class="ti ti-trash"></i><span class="nav-text">Deleted PR's</span>
            </a>
        </li>

        <li class="px-4 py-2">
            <small class="nav-text text-muted">User Management</small>
        </li>

        <li>
            <a class="nav-link {{$usersAllActive}}" href="{{ route('userRead') }}">
                <i class="ti ti-users"></i><span class="nav-text">Users</span>
            </a>
        </li>

        <li class="px-4 py-2">
            <small class="nav-text text-muted">Report Management</small>
        </li>

        <li class="nav-item">
            <a class="nav-link d-flex align-items-center justify-content-between {{ $reportOpen ? '' : '' }}" data-bs-toggle="collapse" href="#reportMenu" role="button" aria-expanded="false" aria-controls="reportMenu">
                <div class="d-flex align-items-center">
                    <i class="ti ti-file me-2"></i>&nbsp;
                    <span class="nav-text">Reports</span>
                </div>
                <!-- <i class="ti ti-chevron-down"></i> -->
            </a>

            <div class="collapse {{ $reportOpen ? 'show' : '' }}" id="reportMenu">
                <ul class="nav flex-column ms-3 mt-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('generate/list1*') ? 'active' : '' }}" href="{{ route('consolidateRead') }}">
                            <i class="ti ti-file"></i> <span class="nav-text">Consolidation 1</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('generate/list2*') ? 'active' : '' }}" href="{{ route('consolidateForm2Read') }}">
                            <i class="ti ti-file"></i> <span class="nav-text">Consolidation 2</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endif

    @if(Auth::user()->role !='Administrator' && Auth::user()->role !='Procurement Officer' && Auth::user()->role !='Checker' && Auth::user()->role !='MIS Checker')
        <li>
            <a class="nav-link {{ $shopUserActive }}" href="{{ route('shoplistRead') }}">
                <i class="ti ti-shopping-cart"></i><span class="nav-text">Shop Item</span>
            </a>
        </li>
        
        <li>
            <a class="nav-link {{ $cartUserActive }}" href="{{ route('prPurposeRequest') }}">
                <i class="ti ti-shopping-cart-check"></i><span class="nav-text">My Cart</span>
            </a>
        </li>
        
        <li>
            <a class="nav-link {{ $pendingUserActive }}" href="{{ route('pendingListRead') }}">
                <i class="ti ti-clock-pin"></i><span class="nav-text">Pending</span>
            </a>
        </li>
        
        <li>
            <a class="nav-link {{ $approvedUserActive }}" href="{{ route('approvedListRead') }}">
                <i class="ti ti-clock-check"></i><span class="nav-text">Approved</span>
            </a>
        </li>
        
        <li>
            <a class="nav-link {{ $returnUserActive }}" href="{{ route('returnedUserListRead') }}">
                <i class="ti ti-rewind-backward-10"></i><span class="nav-text">Returned</span>
            </a>
        </li>
        
        <li>
            <a class="nav-link {{ $canceledUserActive }}" href="{{ route('cancelUserListRead') }}">
                <i class="ti ti-shopping-cart-cancel"></i><span class="nav-text">Canceled</span>
            </a>
        </li>

         <li class="px-4 py-2">
            <small class="nav-text text-muted">Pap's PRE</small>
        </li>

        <li>
            <a class="nav-link" href="#">
                <i class="ti ti-file-excel"></i><span class="nav-text">Create PAPs</span>
            </a>
        </li>
    @endif
    
    @if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'Budget Officer')
        <li class="px-4 py-2">
            <small class="nav-text text-muted">Approval Navigation</small>
        </li>

        <li>
            <a class="nav-link {{ $pendingBudAllActive }}" href="{{ route('pendingAllBudgetListRead') }}">
                <i class="ti ti-shopping-cart-pin"></i><span class="nav-text">Waiting</span><span class="badge bg-warning ms-1" id="pendingBudCount">{{ $data['pendBudCount'] }}</span>
            </a>
        </li>
        
        <li>
            <a class="nav-link {{ $pendingBudCancelAllActive }}" href="{{ route('requestPRcancelBudgetListRead') }}">
                <i class="ti ti-shopping-cart-cancel"></i><span class="nav-text">Cancel</span>
            </a>
        </li>
    @endif

    @if(Auth::user()->role == 'MIS Checker')
        <li>
            <a class="nav-link {{ $pendingAllActive }}" href="{{ route('pendingTechCheckListRead') }}">
                <i class="ti ti-shopping-cart-pin"></i><span class="nav-text">Pending</span>
            </a>
        </li>
    @endif
</ul>

<script>
    var allPendingCountRoute = "{{ route('pendingAllListRead') }}";
    var allPendingBudgetCountRoute = "{{ route('pendingAllBudgetListRead') }}";
    var userPendingCountRoute = "{{ route('pendingListRead') }}";
    var allApprovedCountRoute = "{{ route('approvedListAllRead') }}";
    var userApprovedCountRoute = "{{ route('approvedListRead') }}";
    var allReturnedCountRoute = "{{ route('returnedAllListRead') }}";
    var userReturnedCountRoute = "{{ route('returnedUserListRead') }}";
</script>