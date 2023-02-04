<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">   --->
    <!--  <link rel="stylesheet" href="./{{ asset('assets/fonts/fontawesome-free-5.15.4-web/css/all.css') }}">  --->
    <!--  <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">   --->
    <!--  <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}"> --->
    <!--   <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">  ---->
    <link rel="stylesheet" href="{{ asset('assets/scss2/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/png/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>
    <title>New Site</title>
</head>

<body>
    <div class="main">
        <div class="main-content">
            <section class="my-account">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="card shadow">
                                <img src="{{ asset('assets/img/png/logo.png') }}" alt="" class="card-img">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="input-group-wrapper">
                                            <div class="input-wrapper">
                                                <label for="email" class="form-label">Email</label>
                                                <div class="input-group">
                                                    <input type="text" id="email" name="email"
                                                        class="form-control" placeholder="Email Address">
                                                </div>
                                            </div>
                                            <div class="input-wrapper">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" id="password" name="password"
                                                        class="form-control" placeholder="Password">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
</body>

</html>
