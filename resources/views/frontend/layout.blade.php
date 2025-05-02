<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ellie Store | Home</title>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

 

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
{{-- Links khmer font --}}
<link href="https://fonts.googleapis.com/css2?family=Siemreap&display=swap" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<style>
    * {
        font-family: 'Popins', sans-serif;
    }

    .navbar-nav .nav-link {
        font-size: 16px;
        font-weight: 600;
        margin-right: 15px;
    }

    .nav-link {
        color: #ddd !important;
    }

    .hero {
        background: url('{{ asset("images/banner.jpg") }}') no-repeat center center;
        background-size: cover;
        height: 400px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .hero h1 {
        font-size: 48px;
        font-weight: bold;
    }

    .products {
        padding: 50px 0;
    }

    .product-card {
        border: 1px solid #ddd;
        padding: 20px;
        text-align: center;
        border-radius: 8px;
        transition: 0.3s;
    }

    .product-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .footer {
        background: #222;
        color: white;
        padding: 20px 0;
        text-align: center;
    }

    .header {
        background: #4B2473;
    }

    .nav-link {
        color: white;
    }
</style>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: black; color: white;">
        <div class="container">
            <a class="navbar-brand" href="/home" style="color: #ddd !important "><strong>Ellie Store </strong> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="color: white;">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/product">Shop</a></li>
                    {{-- <li class="nav-item"><a href="/product" class="nav-link">My Cart (<span
                                id="cart-count">{{ session('cart') ? array_sum(session('cart')) : 0 }}</span>)</a>
                    </li> --}}
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    @auth
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="nav-link" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
    @yield('content')


    @include('frontend.home.footer')
    <!-- Hero Section -->
    <!-- Scripts -->
    @yield('script')
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src=" {{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
    <script>

        axios.interceptors.request.use(function (config) {
            // Do something before request is sent
            $.LoadingOverlay("show");
            return config;
        }, function (error) {
            // Do something with request error
            console.error(error);
            $.LoadingOverlay("hide");
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `${error}`,
            });
            return Promise.reject(error);
        });

        // Add a response interceptor
        axios.interceptors.response.use(function (response) {
            // Any status code that lie within the range of 2xx cause this function to trigger
            // Do something with response data
            $.LoadingOverlay("hide");

            return response;

        }, function (error) {
            // Any status codes that falls outside the range of 2xx cause this function to trigger
            // Do something with response error
            $.LoadingOverlay("hide");
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `${error}`,
            });
            return Promise.reject(error);
        });
    </script>


</html>