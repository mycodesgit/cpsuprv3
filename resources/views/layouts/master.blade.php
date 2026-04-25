<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>CPSU || PR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uilibs/images/cpsulogov4.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uilibs/images/cpsulogov4.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uilibs/images/cpsulogov4.png') }}">

    <link rel="stylesheet" href="{{ asset('uilibs/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('uilibs/css/custom.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/fontawesome-free-V6/css/all.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables  -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Summernote -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/fullcalendar/fullcalendar.css') }}">

    <style>
        .nav-link {
            font-size: 14px;
        }

        .nav-link:hover {
            background-color: #f8f9fa;
            border-radius: 6px;
        }

        .collapse .nav-link {
            color: #555;
        }
        .sidebar .nav-link.active {
            color: #000000 !important;
            background-color: #65ac86 !important;
        }
        /* When sidebar is collapsed, remove active background */
        .sidebar.collapsed .nav-link.active,
        .sidebar.collapsed .nav-link:hover {
            background-color: transparent !important;
            color: inherit !important;
        }
        /* main {
            background-color: #f4f6f9;
        } */
        .fc-event {
            border-color: #198754; background-color: #198754;
        }
        @media (max-width: 768px) {
            .fc .fc-daygrid-day-frame {
                min-height: 45px;
            }
        }
        .card-hover {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card-hover:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .sidebar .nav-link .fa {
            font-size: 18px !important;
        }
        .fa {
            font-family: tabler-icons !important;
            speak: none;
            font-style: normal;
            font-weight: 400;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .btn-block {
            display: block;
            width: 100%;
        }
        .swal2-container {
            z-index: 999999 !important;
        }
        .my-swal-on-top {
            z-index: 999999 !important;
        }
    </style>
</head>

<body>
    <div id="overlay" class="overlay"></div>
    <!-- TOPBAR -->
    <nav id="topbar" class="navbar bg-white border-bottom fixed-top topbar px-3">
        <button id="toggleBtn" class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm ">
            <i class="fas fa-bars"></i>
        </button>

        <!-- MOBILE -->
        <button id="mobileBtn" class="btn btn-light btn-icon btn-sm d-lg-none me-2">
            <i class="ti ti-layout-sidebar-left-expand"></i>
        </button>
        <div>
            <!-- Navbar nav -->
            <ul class="list-unstyled d-flex align-items-center mb-0 gap-1">
                <li class="ms-3 dropdown">
                    <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('uilibs/images/user.png') }}" alt="" class="avatar avatar-sm rounded-circle" /> {{ Auth::guard('web')->user()->fname }} {{ Auth::guard('web')->user()->lname }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 200px;">
                        <div>
                            <div class="d-flex gap-3 align-items-center border-dashed border-bottom px-3 py-3">
                                <img src="{{ asset('uilibs/images/user.png') }}" alt="" class="avatar avatar-md rounded-circle" />
                                <div>
                                    <h5 class="mb-0 small">{{ Auth::guard('web')->user()->fname }} {{ Auth::guard('web')->user()->lname }}</h5>
                                    <p class="mb-0 small text-warning">Admin</p>
                                </div>
                            </div>
                            <div class="p-3 d-flex flex-column gap-1 medium lh-lg">
                                <a href="#!" class="text-secondary">
                                    <i class="ti ti-settings"></i> <span>Account Settings</span>
                                </a>
                                <a href="#!" class="text-success">
                                    <i class="ti ti-message"></i><span> Chat Message</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" class="text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ti ti-logout"></i><span> Signout</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <aside id="sidebar" class="sidebar">
        <div class="logo-area">
            <div class="d-inline-flex">
                <img src="{{ asset('uilibs/images/cpsulogov4.png') }}" alt="logo" width="24">
                <span class="logo-text ms-2" style="font-weight: bold">CPSU PR</span>
            </div>
        </div>
        @include('menu.sidebar')

    </aside>

    <!-- MAINmainCONTENT -->
    <main id="content" class="content py-10">
        <div class="container-fluid">
            @yield('body')

            <div class="row">
                <div class="col-12">
                    <footer class="text-center py-2 mt-6 text-secondary fixed-bottom bg-white" style="z-index: 99">
                        <p class="mb-0">CPSU PR V.3.0: Maintained and Managed by Management Information System Office (MISO) under the Leadership of Dr. Aladino C. Moraca.</p>
                    </footer>
                </div>
            </div>

        </div>
    </main>

    <!-- Bootstrap JS -->

    <script type="text/javascript" src="{{ asset('uilibs/js/main.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('uilibs/plugins/jquery/jquery.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('uilibs/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('uilibs/plugins/summernote/summernote-bs4.js') }}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('uilibs/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/fullcalendar/fullcalendar.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('uilibs/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('uilibs/plugins/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('uilibs/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('uilibs/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Validation JS -->
    <script src="{{ asset('uilibs/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script>
        $(function () {
            $('.select2').each(function () {
                $(this).select2({
                    dropdownParent: $(this).closest('.modal'),
                });
            });

            $('.select2bs4').select2({
                theme: 'bootstrap4',
                height: '100',
            })
        });
        document.addEventListener("DOMContentLoaded", function () {
            const cards = document.querySelectorAll('.card-animate');

            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('show');
                }, index * 90); // stagger effect
            });
        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": true,
                "autoWidth": true,
                "info": true,
                "lengthChange": false,
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

    @if (request()->routeIs('dashboard', 'shoplistRead'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('autoPopupModal');
                
                if (!modal) return;

                modal.classList.add('show', 'd-block');
                document.body.classList.add('modal-open');

                const backdrop = document.createElement('div');
                backdrop.className = 'modal-backdrop fade show';
                backdrop.id = 'custom-backdrop';
                document.body.appendChild(backdrop);

                function closeModal() {
                    modal.classList.remove('show');
                    backdrop.classList.remove('show');
                    document.body.classList.remove('modal-open');

                    setTimeout(() => {
                        modal.classList.remove('d-block');

                        const bd = document.getElementById('custom-backdrop');
                        if (bd) bd.remove();
                    }, 200); 
                }

                modal.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
                    btn.addEventListener('click', closeModal);
                });

                // ESC key support
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') closeModal();
                });
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

    @if (request()->routeIs('categoryRead'))
        @include('myscript.manage.categorySerialize')
    @endif
    @if (request()->routeIs('unitRead'))
        @include('myscript.manage.unitSerialize')
    @endif
    @if (request()->routeIs('itemRead'))
        @include('myscript.manage.itemSerialize')
    @endif
    @if (request()->routeIs('officeRead'))
        @include('myscript.manage.officeSerialize')
    @endif
    @if (request()->routeIs('yearRead'))
        @include('myscript.manage.yearSerialize')
    @endif
    @if (request()->routeIs('pendingAllListRead'))
        @include('myscript.pending.allpendingCheckerSerialize')
    @endif
    @if (request()->routeIs('approvedListAllRead'))
        @include('myscript.approve.allapprovedSerialize')
        @include('myscript.approve.acceptanceSerialize')
    @endif
    @if (request()->routeIs('archiveShow'))
        @include('myscript.archivepr.archiveSerialize')
        @include('myscript.approve.acceptanceSerialize')
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

    @if (request()->routeIs('shoplistRead'))
        @include('myscript.cartongoing.shoplistSerialize')
        @include('myscript.add.addItem')
    @endif
    @if(request()->routeIs('selectItems', 'editreturnselectItems'))
        @include('myscript.add.addItem')
        @include('myscript.add.cartTable')
    @endif
    @if (request()->routeIs('prPurposeRequest'))
        @include('myscript.cartongoing.mycart')
    @endif
</body>

</html>