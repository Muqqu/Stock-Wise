<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-image-lightbox@1.4.4/dist/image-lightbox.min.css">
    <link rel="stylesheet" href="{{asset('./assets/fonts/fontawesome-free-5.15.4-web/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/style.css')}}">

    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>

    <link rel="icon" type="image/png" href="{{asset('assets/img/png/logo.png')}}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
     <script defer src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    
    
    <script defer src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/9.23.0/firebase-analytics.js"></script>

<!-- <script defer src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>
<script defer src="https://www.gstatic.com/firebasejs/8.10.1/firebase-firestore.js"></script> -->

<script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-messaging.js"></script>
<script src="{{ asset('assets/js/init-firebase.js') }}"></script>


    <title>Admin Dashboard</title>

</head>

<body>
    <div class="main">
        <div class="main-content">
            <div id="sidebar" class="sidebar">
                <a class="sidebar-brand" href="https://thugidash.stock-wise.online/dashboard"><img src="{{asset('assets/img/png/logo.png')}}" alt=""></a>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{route('dashboardpage')}}" class="nav-link active">
                            <img class="dark" src="{{asset('assets/img/svg/dashboard-solid.svg')}}" alt="">
                            <img class="light" src="{{asset('assets/img/svg/dashboard-dark.svg')}}" alt="">
                            <span>Dashboards</span>
                        </a>
                    </li>

                   <li class="nav-item" role="presentation">
                    <a href="{{route('manageuserpage')}}" class="nav-link">
                            <img class="dark" src="{{asset('assets/img/svg/user-solid.svg')}}" alt="">
                            <img class="light" src="{{asset('assets/img/svg/user-dark.svg')}}" alt="">
                            <span>Manage Users</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                    <a href="{{route('transactionpage')}}" class="nav-link">
                            <img class="dark" src="{{asset('assets/img/svg/transaction-solid.svg')}}" alt="">
                            <img class="light" src="{{asset('assets/img/svg/transaction-dark.svg')}}" alt="">
                            <span>Transactions</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                    <a href="{{route('withdrawpage')}}" class="nav-link">
                            <img class="dark" src="{{asset('assets/img/svg/withdraw-solid.svg')}}" alt="">
                            <img class="light" src="{{asset('assets/img/svg/withdraw-dark.svg')}}" alt="">
                            <span>Withdraw Requests</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                    <a href="{{route('companypage')}}" class="nav-link">
                            <img class="dark" src="{{asset('assets/img/svg/stock-solid.svg')}}" alt="">
                            <img class="light" src="{{asset('assets/img/svg/stock-dark.svg')}}" alt="">
                            <span>Companies</span>
                        <a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="{{route('buystock')}}" class="nav-link">
                            <img class="dark" src="{{asset('assets/img/svg/stock-solid.svg')}}" alt="">
                            <img class="light" src="{{asset('assets/img/svg/stock-dark.svg')}}" alt="">
                            <span>Buy Stock</span>
                        </a>
                    </li>
                </ul>
            </div>
            <section class="dashboard content">
                <div class="custom-header">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <button id="sidebar-toggler" class="sidebar-toggler">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <div class="main-title">
                                    <h1>Hellow Admin</h1>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="" class="notification active"><img src="{{asset('assets/img/svg/notifiction.svg')}}"
                                        alt=""></a>
                                <div class="position-relative">
                                    <a class="user-img active" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880 alt="">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="{{ route('logout') }}" class="dropdown-item" type="button">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
