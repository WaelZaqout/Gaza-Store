@extends('admin.master')
@section('content')
    <style>
        .dataTables_length,
        .dataTables_filter {
            display: none !important;
        }
        .dataTables_info,
        .dataTables_paginate {
         display: none !important;
         }


        .search-filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: space-between;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .search-filter-container input,
        .search-filter-container select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .search-btn:hover {
            background: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #343a40;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
        }

        tr:hover {
            background: #f1f1f1;
            transition: 0.3s;
        }

        .btn-primary {
            background: #007bff;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-danger {
            background: #dc3545;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-danger:hover {
            background: #a71d2a;
        }
        #customersTable_wrapper {
        height: 100%;
        overflow-y: auto;
        }

        .card-body {
            max-height: 600px; /* زيادة الارتفاع */
            overflow-y: auto; /* تمكين التمرير داخل الجدول فقط */
        }

    </style>

    <body id="page-top">
        <div id="wrapper" class="d-flex">
            <div id="content-wrapper">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-gray-800">Dashboard</h2>
                    <button class="btn btn-primary shadow"><i class="fas fa-download"></i> Generate Report</button>
                </div>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary p-3">
                            <h5>Earnings (Monthly)</h5>
                            <h3>${{ number_format($monthlyEarnings, 2) }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success p-3">
                            <h5>Total Sales</h5>
                            <h3>${{ number_format($totalSales, 2) }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info p-3">
                            <h5>Total Orders</h5>
                            <h3>{{ number_format($totalOrders) }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning p-3">
                            <h5>Total Users</h5>
                            <h3>{{ number_format($totalUsers) }}</h3>
                        </div>
                    </div>
                </div>

             @include('admin.parts.search')
             <div class="row">
                <!-- قسم الطلبات -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5>Recent Orders</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="ordersTable">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user_id }}</td>
                                            <td>${{ number_format($order->total_price, 2) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $order->status == 'Pending' ? 'warning' : 'success' }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="{{ route('admin.orders.details', $order->id) }}">
                                                    <i class="fas fa-info-circle"></i> Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- قسم الزبائن -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white d-flex justify-content-between">
                            <h5>Customers</h5>
                            <input type="text" id="searchCustomer" class="form-control w-50" placeholder="Search by Name">
                        </div>
                        <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                            <table class="table table-sm table-bordered table-hover" id="customersTable">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->phone ?? 'N/A' }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-info" href="{{ route('admin.customers.show', $user->id) }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            </div>
        </div>
    </body>

    @section('js')

    @endsection
@endsection
