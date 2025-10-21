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
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/assets/js/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/js/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Summernote -->
    <link rel="stylesheet" href="{{ asset('template/assets/modules/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/modules/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/modules/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/modules/jquery-selectric/selectric.css') }}">
    
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
        ::-webkit-scrollbar {
            width: 5px !important;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1 !important;
        }
        ::-webkit-scrollbar-thumb {
            background: #888 !important;
            border-radius: 5px !important;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555 !important;
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
        /* Force Select2 to match Bootstrap .form-control-sm */
        .select2-container--default .select2-selection--single {
            height: calc(1.8125rem + 2px) !important; /* ~31px (same as .form-control-sm) */
            min-height: calc(1.8125rem + 2px) !important;
            /* border: 1px solid #ced4da !important; */
            border-radius: .2rem !important;
            font-size: 0.875rem !important;
            padding: 0.25rem 0.5rem !important;
            display: flex !important;
            align-items: center !important; /* vertical align */
        }

        /* Adjust text inside */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 0 !important;
            line-height: 3 !important;
            font-size: 0.875rem !important;
        }

        /* Adjust arrow size + position */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
            top: 50% !important;
            transform: translateY(-50%); /* center vertically */
        }

        #clearSearch {
            border: none;
            background: #a5a5a5;
            cursor: pointer;
        }
        /* Blurred background when modal is shown */
        body.modal-open::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            z-index: 1040; /* Just below the modal backdrop */
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
                        <input class="form-control" type="search" value="Balance: 0.00" aria-label="Search"
                            data-width="250" style="background-color: rgb(47, 107, 77); border-radius: 5px; color: #fff" readonly>
                    </div>
                </form>
                <ul class="navbar-nav navbar-right">
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
                            @if(session('login_time'))
                                <div id="login-status" class="dropdown-title" style="font-family: Arial; font-size: 12pt">
                                    <i class="fas fa-clock" style="font-size: 12pt"></i> <span id="login-timer">00:00:00</span>
                                </div>

                                <script>
                                    const loginTime = new Date("{{ \Carbon\Carbon::parse(session('login_time'))->toIso8601String() }}");

                                    function pad(num) {
                                        return String(num).padStart(2, '0');
                                    }

                                    function updateLoginStatus() {
                                        const now = new Date();
                                        const diff = Math.floor((now - loginTime) / 1000);

                                        const hours = Math.floor(diff / 3600);
                                        const minutes = Math.floor((diff % 3600) / 60);
                                        const seconds = diff % 60;

                                        const timeStr = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
                                        document.getElementById("login-timer").innerText = timeStr;
                                    }

                                    updateLoginStatus();
                                    const timer = setInterval(updateLoginStatus, 1000);

                                    // Stop timer on logout
                                    document.querySelector('a.dropdown-item.text-danger')?.addEventListener('click', function () {
                                        clearInterval(timer);
                                    });
                                </script>
                            @endif

                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    <!-- Summernote -->
    <script src="{{ asset('template/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <!-- Chartjs -->
    <script src="{{ asset('template/assets/js/chart.js/Chart.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('template/assets/js/select2/js/select2.full.min.js') }}"></script>
    
    <!-- Page Specific JS File -->
    <script>
        var userPendingCountRoute = "{{ route('pendingListRead') }}";
        var userApprovedCountRoute = "{{ route('approvedListRead') }}";
        var userReturnCountRoute = "{{ route('returnedUserListRead') }}";
    </script>
    
    @include('myscript.table.dataTable')
    @include('myscript.count.allcountbadge')
    @include('myscript.notif.allnotifbadge')

    @if (request()->routeIs('dashboard'))
        @include('myscript.dash.donutChart')
        <script>
            $('.summernote-simple').summernote({
            toolbar: false,      // hides the toolbar
            airMode: false,      // disables floating toolbar
            disableResizeEditor: true,
            height: 400,         // set height (optional)
            disableDragAndDrop: true,
            callbacks: {
                onInit: function() {
                // Make editor readonly
                $(this).next('.note-editor').find('.note-editable').attr('contenteditable', false);
                }
            }
            });
        </script>
    @endif

    @if (request()->routeIs('categoryRead'))
        @include('myscript.manage.categorySerialize')
        @include('myscript.manage.unitSerialize')
        @include('myscript.manage.itemSerialize')
        @include('myscript.manage.officeSerialize')
        @include('myscript.manage.yearSerialize')
    @endif
    @if (request()->routeIs('shoplistRead'))
        @include('myscript.cartongoing.shoplistSerialize')
        @include('myscript.add.addItem')
    @endif
    
    @if (request()->routeIs('pendingAllListRead'))
        @include('myscript.pending.allpendingCheckerSerialize')
    @endif
    @if (request()->routeIs('pendingTechCheckListRead'))
        @include('myscript.pending.allpendingTechCheckerSerialize')
    @endif
    @if (request()->routeIs('pendingAllBudgetListRead'))
        @include('myscript.pending.allpendingBudgetSerialize')
    @endif

    @if (request()->routeIs('shop'))
        @include('myscript.add.shopScript')
    @endif
    @if(request()->routeIs('selectItems', 'editreturnselectItems'))
        @include('myscript.add.addItem')
        @include('myscript.add.cartTable')
    @endif

    @if (request()->routeIs('prPurposeRequest'))
        @include('myscript.cartongoing.mycart')
    @endif

    @if (request()->routeIs('pendingListRead'))
        @include('myscript.pending.allpendingUserSerialize')
    @endif

    @if (request()->routeIs('approvedListAllRead'))
        @include('myscript.approve.allapprovedSerialize')
        @include('myscript.approve.acceptanceSerialize')
    @endif
    @if (request()->routeIs('approvedListBudAllRead'))
        @include('myscript.approve.allBudapprovedSerialize')
    @endif
    @if (request()->routeIs('approvedListRead'))
        @include('myscript.approve.allUserapprovedSerialize')
    @endif
    @if (request()->routeIs('returnedUserListRead'))
        @include('myscript.return.returnprUserSerialize')
    @endif
    @if (request()->routeIs('cancelUserListRead'))
        @include('myscript.return.canceledprUserSerialize')
    @endif
    @if (request()->routeIs('papsYearRead'))
        @include('myscript.ppmpplan.papsplanSerialize')
    @endif
    @if (request()->routeIs('viewlistpapspre'))
        @include('myscript.ppmpplan.papsplandetailSerialize')
        @include('myscript.ppmpplan.papsplandetailScript')
        <script>
            $(document).on("change", ".papstitle-select", function () {
                let code = $(this).find(":selected").data("code");
                let row = $(this).closest(".ppmp-row");
                row.find(".papscode-input").val(code);
            });
        </script>
    @endif
    @if (request()->routeIs('papspreitemsppmp'))
        @include('myscript.ppmpplan.papsplanppmpdetailSerialize')
    @endif
    @if (request()->routeIs('ppmpYearRead'))
        @include('myscript.ppmpplan.procplanSerialize')
    @endif
    @if (request()->routeIs('viewlistppmp'))
        @include('myscript.ppmpplan.procplandetailSerialize')
    @endif
    @if (request()->routeIs('requestPRcancelBudgetListRead'))
        @include('myscript.return.canceledprReqbyUserSerialize')
    @endif
    @if (request()->routeIs('archiveShow'))
        @include('myscript.archivepr.archiveSerialize')
    @endif
    @if (request()->routeIs('archiveDeletedShow'))
        @include('myscript.archivepr.archivedeletedSerialize')
    @endif
    @if (request()->routeIs('annouceInfo'))
        @include('myscript.announce.otherAnnounceSerialize')
        <script>
            $(function () {
                $('#summernote').summernote({
                    height: 400 
                });
                $('#summernoteother').summernote({
                    height: 300 
                });
                $('.summernoteotheredit').summernote({
                    height: 300,
                    // toolbar: [         // keep it simple
                    //     ['style', ['bold', 'italic', 'underline', 'clear']],
                    //     ['para', ['ul', 'ol', 'paragraph']],
                    //     ['insert', ['link']],
                    //     ['view', ['codeview']]
                    // ]
                });
            })
        </script>
    @endif
    @if (request()->routeIs('userRead'))
        @include('myscript.user.userSerialize')
    @endif

    @if (request()->routeIs('dashboard', 'shoplistRead'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var autoPopupModal = document.getElementById('autoPopupModal');

                if (autoPopupModal) {
                    var myModal = new bootstrap.Modal(autoPopupModal, {
                        backdrop: 'absolute',
                        keyboard: false
                    });

                    myModal.show();
                }
            });
        </script>

        @if ($annoucement)
            <script>
                function updateCountdown(endDate) {
                    var now = new Date();
                    var difference = endDate - now;

                    var hours = Math.floor(difference / (1000 * 60 * 60));
                    var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((difference % (1000 * 60)) / 1000);

                    var hoursBox = document.getElementById("hoursBox");
                    var minutesBox = document.getElementById("minutesBox");
                    var secondsBox = document.getElementById("secondsBox");

                    if (hoursBox && minutesBox && secondsBox) {
                        hoursBox.innerHTML = formatTime(hours);
                        minutesBox.innerHTML = formatTime(minutes);
                        secondsBox.innerHTML = formatTime(seconds);
                    }

                    if (difference <= 0) {
                        clearInterval(intervalId);
                        if (hoursBox && minutesBox && secondsBox) {
                            hoursBox.innerHTML = "00";
                            minutesBox.innerHTML = "00";
                            secondsBox.innerHTML = "00";
                        }
                    }
                }

                function formatTime(time) {
                    return time < 10 ? "0" + time : time;
                }

                var endDate = new Date("{{ $annoucement->dateend }}");
                var intervalId = setInterval(function () {
                    updateCountdown(endDate);
                }, 1000);
            </script>
        @endif
    @endif
    
    <script>
        document.body.style.zoom = "90%"; 
    </script>

</body>
</html>
