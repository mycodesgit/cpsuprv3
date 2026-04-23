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
            <a class="nav-link {{$archiveActive}}" href="{{ route('archiveRead') }}">
                <i class="ti ti-file-zip"></i><span class="nav-text">Archived</span>
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