<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', env('APP_NAME'))</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('back/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="{{ asset('back/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @yield('css')
    @if (App::getLocale() == 'ar')
        <style>
            .topbar .dropdown .dropdown-menu {
                right: -60%;
            }

            body {
                direction: rtl;
                text-align: right;
            }

            .sidebar {
                padding: 0;
            }

            .sidebar .nav-item .nav-link {
                text-align: right;

            }

            .sidebar .nav-item .nav-link[data-toggle=collapse]::after {
                float: left;
                transform: rotate(180deg)
            }

            .ml-auto,
            .mx-auto {
                margin-left: unset !important;
                margin-right: auto !important;
            }
        </style>
    @endif

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        {{-- <ul>
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul> --}}
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i class="fas fa-globe"></i>
                                    {{ __('admin.langs') }}</span>

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                @endforeach

                            </div>
                        </li>

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}
                                </span>

                                @php

                                    if (Auth::user()->image) {
                                        $src = asset('images/' . Auth::user()->image->path);
                                    } else {
                                        $src =
                                            'https://ui-avatars.com/api/?background=random&name=' . Auth::user()->name;
                                    }

                                @endphp

                                <img class="img-profile rounded-circle" src="{{ $src }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">


                                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item"><i
                                            class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('admin.out') }}</button>
                                </form>

                            </div>
                        </li>

                    </ul>


                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('back/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('back/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('back/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src={{ asset('back/js/sb-admin-2.min.js') }}"></script>


    @yield('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        let userId = '{{ Auth::id()}}'
    </script>
    @vite(['resources/js/app.js'])

<!-- إضافة الـ CSS و الـ JS الخاصة بـ Select2 -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('back/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('back/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('back/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    {{-- <script src="{{ asset('back/js/sb-admin-2.min.js') }}"></script> --}}

    <!-- Page level plugins -->
    <script src="{{ asset('back/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('back/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('back/js/demo/chart-pie-demo.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateIndexStats() {  // ✅ الاسم صحيح الآن
            $.ajax({
                url: "{{ url('/admin/index/stats') }}",  // ✅ تأكد أن هذا المسار صحيح في routes/web.php
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log("Data updated:", data);
                    $("#monthlyEarnings").text(`$${data.monthlyEarnings}`);
                    $("#totalSales").text(`$${data.totalSales}`);
                    $("#totalOrders").text(data.totalOrders);
                    $("#totalUsers").text(data.totalUsers);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching index stats:", error);
                }
            });
        }

        // ✅ تحديث البيانات كل 6 ثوانٍ
        setInterval(updateIndexStats, 20000);

        // ✅ تحديث البيانات عند تحميل الصفحة
        $(document).ready(function() {
            updateIndexStats();
        });
    </script>

<!-- Scripts for Chart.js and AJAX -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let earningsChart, revenueChart;

    function loadChartData() {
        $.ajax({
            url: "{{ url('/admin/chart-data') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log("Data Loaded:", data);

                // تحديث مخطط الأرباح الشهرية (Area Chart)
                let months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                let earningsData = new Array(12).fill(0);

                Object.keys(data.earnings).forEach(month => {
                    earningsData[month - 1] = data.earnings[month]; // ضبط القيم حسب الأشهر
                });

                if (earningsChart) earningsChart.destroy(); // حذف الرسم القديم لمنع التكرار

                let ctx1 = document.getElementById('myAreaChart').getContext('2d');
                earningsChart = new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Earnings ($)',
                            data: earningsData,
                            backgroundColor: 'rgba(78, 115, 223, 0.1)',
                            borderColor: 'rgba(78, 115, 223, 1)',
                            borderWidth: 2,
                            pointRadius: 3,
                            pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                            pointBorderColor: 'rgba(255, 255, 255, 0.8)'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // تحديث مخطط مصادر الإيرادات (Pie Chart)
                if (revenueChart) revenueChart.destroy(); // حذف الرسم القديم لمنع التكرار

                let ctx2 = document.getElementById('myPieChart').getContext('2d');
                revenueChart = new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(data.revenueSources),
                        datasets: [{
                            data: Object.values(data.revenueSources),
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf']
                        }]
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error loading chart data:", error);
            }
        });
    }

    // تحميل البيانات عند تحميل الصفحة
    $(document).ready(function() {
        loadChartData();

        // تحديث البيانات كل 10 ثوانٍ
        setInterval(loadChartData, 10000);
    });
</script>
</body>

</html>
