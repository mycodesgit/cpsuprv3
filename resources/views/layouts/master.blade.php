<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CPSU || Purchase Request {{ isset($title) ? '| ' . $title : '' }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('template/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/modules/fontawesome-free-V6/css/all.min.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/assets/js/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/assets/js/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    
    <!-- dataTables Libraries -->
    <link rel="stylesheet"
        href="{{ asset('template/assets/js/tables/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/assets/js/tables/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/assets/js/tables/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/components.min.css') }}">

    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('template/assets/img/cpsulogov4.png') }}">

    <style>
        body {
            overflow-x: hidden;
        }

        @media (max-width: 576px) {
            .main-navbar {
                margin-right: 5px !important;
            }
        }

        /* Add margin-left when sidebar is collapsed */
        body.sidebar-mini .main-sidebar,
        .main-sidebar.sidebar-mini,
        body.sidebar-collapsed .main-sidebar,
        .main-sidebar.sidebar-collapsed {
            margin-left: 5px !important;
        }
        
        body.sidebar-mini .main-sidebar .sidebar-menu li a,
        body.sidebar-collapsed .main-sidebar .sidebar-menu li a {
            margin-left: 0px !important;
        }


        .styled-table thead tr {
            border-bottom: 2px solid #009879;
            border-top: 2px solid #009879;
            color: #000;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
            color: #000;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 1px solid #009879;
        }

        .toast-top-right {
            margin-top: 80px;
        }
        @media (max-width: 772px) {
            .logout-button-container {
                width: 50% !important;
                left: 5%;
            }
        }

        @media (min-width: 769px) {
            .logout-button-container {
                width: 18%;
                left: 5;
            }
        }
        .notification-toggle {
            position: relative;
        }

        #notifCount {
            position: absolute;
            top: 0px;
            right: 0px;
            transform: translate(10%, -30%);
            font-size: 10px;
            font-weight: bold;
            padding: 2px 5px;
            border-radius: 20%;
            min-width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .blink {
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0%, 50%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        select.form-control-sm {
            height: calc(1.8125rem + 2px) !important;
            padding: .25rem .5rem !important;
            font-size: .875rem !important;
            line-height: 1.5 !important;
            border-radius: .2rem !important;
        }
    </style>
</head>

<body class="layout-4">
    <!-- Page Loader -->
    <!-- <div class="page-loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div> -->

    <div id="app">
        <div class="main-wrapper main-wrapper-1" style="background-color: #f4f6f9;">
            <!-- <div class="navbar-bg"></div> -->
            <div style="height: 15px; background: #f4f6f9; position: fixed; top: 0; left: 0; right: 0; z-index: 998;">
            </div>
            <!-- Start app top navbar -->
            <nav class="navbar navbar-expand-lg main-navbar"
                style="background: linear-gradient(135deg, #3a7d5c 0%, #1f5036 100%); position: fixed; margin-top: 15px; border-radius: 5px; margin-right: 0; z-index: 999">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                                <i class="fas fa-bars text-white"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none">
                                <i class="fas fa-search"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="search-element">
                        <input class="form-control" type="search" value="Balance: 2, 500, 530.00" aria-label="Search"
                            data-width="250" style="background-color: rgb(47, 107, 77); border-radius: 5px; color: #fff" readonly>
                    </div>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep">
                            <i class="fas fa-cart-plus text-white"></i>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Messages
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-message">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image"
                                            src="{{ asset('template/assets/img/avatar/avatar-1.png') }}"
                                            class="rounded-circle">
                                        <div class="is-online"></div>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b>
                                        <p>Hello, Bro!</p>
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image"
                                            src="{{ asset('template/assets/img/avatar/avatar-2.png') }}"
                                            class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Dedik Sugiharto</b>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image"
                                            src="{{ asset('template/assets/img/avatar/avatar-3.png') }}"
                                            class="rounded-circle">
                                        <div class="is-online"></div>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Agung Ardiansyah</b>
                                        <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image"
                                            src="{{ asset('template/assets/img/avatar/avatar-4.png') }}"
                                            class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Ardian Rahardiansyah</b>
                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                                        <div class="time">16 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image"
                                            src="{{ asset('template/assets/img/avatar/avatar-5.png') }}"
                                            class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Alfa Zulkarnain</b>
                                        <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown"
                            class="nav-link notification-toggle nav-link-lg">
                            <i class="far fa-bell text-white"></i>
                            <span class="badge badge-warning navbar-badge" id="notifCount">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <strong class="pl-3 text-muted"><i class="fas fa-exclamation-circle"></i> Unread</strong>
                                <div id="unreadNotifItems" class="notif-container"></div>
                                <br>
                                <strong class="pl-3 text-muted"><i class="fas fa-exclamation-circle"></i> Read</strong>
                                <div id="readNotifItems" class="notif-container"></div>
                            </div>
                            <div class="dropdown-footer text-center">
                                {{-- <a href="#">View All <i class="fas fa-chevron-right"></i></a> --}}
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('template/assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block text-white">Hi, {{ Auth::user()->fname }} {{ Auth::user()->lname }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-activities.html" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Start main left sidebar menu -->
            <div class="main-sidebar sidebar-style-2"
                style="background: linear-gradient(135deg, #3a7d5c 0%, #1f5036 100%);">
                @include('menu.sidebar')
            </div>

            <!-- Start app main Content -->
            <div class="main-content" style="background-color: #f4f6f9;">
                @yield('body')
            </div>

            <!-- Start app Footer part -->
            <footer class="main-footer">
                <div
                    style="background: linear-gradient(135deg, #ffffff 0%, #f8f8f8 50%, #ececec 100%); border-radius: 5px; padding: 10px;">
                    &nbsp;
                    <div class="footer-left">
                        <div>Maintained and Managed by Management Information System Office (MISO) under the Leadership
                            of Dr. Aladino C. Moraca.</div>
                    </div>
                    <div class="footer-right">
                        <div>V.3</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('template/assets/bundles/lib.vendor.bundle.js') }}"></script>
    <script src="{{ asset('template/js/CodiePie.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('template/js/scripts.js') }}"></script>
    <script src="{{ asset('template/js/custom.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('template/assets/js/toastr/toastr.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('template/assets/js/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- JS Libraies -->
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template/assets/js/tables/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": true,
                "autoWidth": true,
                //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            $("#example3").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

            $("#example4").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "searching": true,
                "buttons": ["excel"]

            }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        function updateNotificationBlink() {
            const notifCount = document.getElementById('notifCount');
            const count = parseInt(notifCount.innerText);

            if (count > 0) {
                notifCount.classList.add('blink');
            } else {
                notifCount.classList.remove('blink');
            }
        }

        // Run it on page load
        document.addEventListener('DOMContentLoaded', updateNotificationBlink);

        // Optional: Call this again after AJAX updates
        // Example: updateNotificationBlink(); after count update
    </script>


    <!-- Page Specific JS File -->
    @if (request()->routeIs('categoryRead'))
        @include('script.manage.categorySerialize')
        @include('script.manage.unitSerialize')
        @include('script.manage.itemSerialize')
        @include('script.manage.officeSerialize')
        @include('script.manage.yearSerialize')
    @endif
    
    @if (request()->routeIs('pendingAllListRead'))
        @include('script.pending.allpendingCheckerSerialize')
    @endif
    @if (request()->routeIs('pendingTechCheckListRead'))
        @include('script.pending.allpendingTechCheckerSerialize')
    @endif
    @if (request()->routeIs('pendingAllBudgetListRead'))
        @include('script.pending.allpendingBudgetSerialize')
    @endif

    @if (request()->routeIs('shop'))
        @include('script.add.shopScript')
    @endif
    @if(request()->routeIs('selectItems', 'editreturnselectItems'))
        @include('script.add.addItem')
        @include('script.add.cartTable')

        <script>
        function resetFormFields() {
            $('input[name="qty"]').val('');
            $('input[name="total_cost"]').val('');
        }
        $(document).ready(function() {
            $(document).on('click', '.btn-selectitem', function(e) {
                e.preventDefault();

                var itemId = $(this).data('id');
                var itemName = $(this).closest('tr').find('td:eq(1)').text();
                var unitId = $(this).closest('tr').find('td:eq(0)').text();
                var unitName = $(this).closest('tr').find('td:eq(2)').text();
                var itemCost = $(this).closest('tr').find('td:eq(3)').text();

                $('input[name="item_id"]').val(itemId);
                $('input[name="item_name"]').val(itemName);
                $('input[name="unit_id"]').val(unitId);
                $('input[name="unit_name"]').val(unitName);
                $('input[name="item_cost"]').val(itemCost);

                resetFormFields();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: '{{ route('getCategories') }}',
                dataType: 'json',
                success: function(response) {
                    var select = $('#categorySelect');
                    select.empty();
                    select.append('<option disabled selected>Select</option>');
                    $.each(response.categories, function(index, category) {
                        select.append('<option value="' + category.id + '">' + category
                            .category_name + '</option>');
                    });
                },
                error: function(error) {
                    console.error('Error fetching categories:', error);
                }
            });

            $('.shop-btn').on('click', function() {
                var categoryId = $(this).data('category-id');
                var categoryName = $(this).closest('.rounded').find('h3').text();
                var selectedCategoryDropdown = $('#categorySelect');

                selectedCategoryDropdown.find('option[value="selectedCategory"]').remove();

                if (categoryId) {
                    selectedCategoryDropdown.append('<option value="' + categoryId + '" selected>' +
                        categoryName + '</option>');
                } else {
                    selectedCategoryDropdown.append('<option disabled selected>Select</option>');
                }
            });
        });
    </script>
    @endif

    @if (request()->routeIs('prPurposeRequest'))
        @include('script.cartongoing.mycart')
    @endif

    @if (request()->routeIs('pendingListRead'))
        @include('script.pending.allpendingUserSerialize')
    @endif

    @if (request()->routeIs('approvedListAllRead'))
        @include('script.approve.allapprovedSerialize')
    @endif
    @if (request()->routeIs('approvedListRead'))
        @include('script.approve.allUserapprovedSerialize')
    @endif
    @if (request()->routeIs('returnedUserListRead'))
        @include('script.return.returnprUserSerialize')
    @endif

    @if (request()->routeIs('userRead'))
        @include('script.user.userSerialize')
    @endif


    <script>
        $(document).ready(function() {
            function fetchNotifications() {
                $.ajax({
                    url: "{{ route('notifications.fetch') }}", 
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#notifCount').text(data.unread_count > 0 ? data.unread_count : '0');
    
                        let unreadNotifItems = $('#unreadNotifItems');
                        let readNotifItems = $('#readNotifItems');
                    
                        unreadNotifItems.empty();
                        readNotifItems.empty();
                        // Add Unread Notifications
                        if (data.unread.length > 0) {
                            data.unread.forEach(function(notif) {
                                let notifItem = `<a href="#" class="dropdown-item dropdown-item-unread notification-item unread" 
                                    data-id="${notif.id}">
                                    <i class="fas fa-bell icon text-success"></i>
                                    <div class="dropdown-item-desc">
                                        <strong>${notif.message}</strong>
                                        <div class="notification-time">${notif.time_ago}</div>
                                    </div>
                                </a>`;
                                unreadNotifItems.append(notifItem);
                            });
                        } else {
                            unreadNotifItems.append('<a href="#" class="dropdown-item text-center text-muted">No new notifications</a>');
                        }
                        // Add Read Notifications
                        if (data.read.length > 0) {
                            data.read.forEach(function(notif) {
                                let notifItem = `<a href="#" class="dropdown-item dropdown-item notification-item read" 
                                    data-id="${notif.id}">
                                    <i class="fas fa-check-circle icon text-success"></i>
                                    <div class="dropdown-item-desc">
                                        ${notif.message}
                                        <div class="notification-time">${notif.time_ago}</div>
                                    </div>
                                </a>`;
                                readNotifItems.append(notifItem);
                            });
                        }
                        // Hide sections if empty
                        $('#unreadNotifSection').toggle(unreadNotifItems.children().length > 0);
                        $('#readNotifSection').toggle(readNotifItems.children().length > 0);
                    }
                });
            }
    
            // Mark notification as read when clicked
            $(document).on('click', '.notification-item.unread', function() {
                let notifId = $(this).data('id');
                let clickedItem = $(this);
    
                $.ajax({
                    url: "{{ route('notifications.markAsRead') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: notifId
                    },
                    success: function() {
                        clickedItem.removeClass('unread').addClass('read');
                        fetchNotifications(); // Refresh UI
                    }
                });
            });
    
            // Fetch notifications every 5 seconds
            setInterval(fetchNotifications, 5000);
            fetchNotifications();
        });
    </script>
</body>

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->

</html>
