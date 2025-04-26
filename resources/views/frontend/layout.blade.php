<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ellie Store      | Home</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Source Sans Pro', sans-serif;
        }
        .navbar-nav .nav-link {
            font-size: 16px;
            font-weight: 600;
            margin-right: 15px;
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
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .footer {
            background: #222;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .header{
          background: #4B2473;
        }
        .nav-link {
            color: white;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #4B2473; color: white;">
    <div class="container">
        <a class="navbar-brand" href="/" style="color: #ddd !important "><strong>Ellie Store </strong> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="color: white;">
            <ul class="navbar-nav ms-auto" >
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/shop">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="/blog">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                @auth
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

<!-- Hero Section -->
{{-- <div class="hero">
    <h1 class="text-black" >Welcome to COZA Store</h1>
</div> --}}

<!-- Products Section -->
{{-- <div class="container products">
    <h2 class="text-center mb-4">Our Products</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="product-card">
                <img src="{{ asset('images/product1.jpg') }}" class="img-fluid" alt="Product 1">
                <h4>Product Name</h4>
                <p>$29.99</p>
                <button class="btn btn-primary">Add to Cart</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="product-card">
                <img src="{{ asset('images/product2.jpg') }}" class="img-fluid" alt="Product 2">
                <h4>Product Name</h4>
                <p>$39.99</p>
                <button class="btn btn-primary">Add to Cart</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="product-card">
                <img src="{{ asset('images/product3.jpg') }}" class="img-fluid" alt="Product 3">
                <h4>Product Name</h4>
                <p>$49.99</p>
                <button class="btn btn-primary">Add to Cart</button>
            </div>
        </div>
    </div>
</div> --}}

<!-- Footer -->
{{-- <footer class="footer">
    <p>© 2025 COZA Store. All Rights Reserved.</p>
</footer> --}}

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
