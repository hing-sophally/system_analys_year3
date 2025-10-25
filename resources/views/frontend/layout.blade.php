<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecommerce Store | @yield('title', 'Home')</title>
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
    .text-muted{
        color: white !important;
    }
    
    /* Cart and Wishlist Styles */
    .offcanvas {
        width: 400px !important;
    }
    
    .cart-item, .wishlist-item {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .cart-item:hover, .wishlist-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .badge {
        font-size: 0.75em;
    }
    
    .nav-link {
        position: relative;
    }
    
    .nav-link .badge {
        position: absolute;
        top: -5px;
        right: -5px;
        min-width: 18px;
        height: 18px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: black; color: white;">
        <div class="container">
            <a class="navbar-brand" href="/" style="color: #ddd !important "><strong>Ecommerce Store</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="color: white;">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/product">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    
                    <!-- Cart and Wishlist Icons -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="cart-toggle" style="color: white !important;" onclick="openCartPopup()">
                            <i class="fas fa-shopping-cart me-1"></i>
                            Cart
                            <span class="badge bg-danger ms-1" id="cart-count">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="wishlist-toggle" style="color: white !important;" onclick="openWishlistPopup()">
                            <i class="fas fa-heart me-1"></i>
                            Wishlist
                            <span class="badge bg-danger ms-1" id="wishlist-count">0</span>
                        </a>
                    </li>
                    
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('frontend.profile') }}">Profile</a></li>
                                @if(Auth::user()->role !== 'user')
                                    <li><a class="dropdown-item" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('frontend.orders') }}">My Orders</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('frontend.register') }}">Register</a></li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
    @yield('content')

    <!-- Cart Popup Modal -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="cartOffcanvasLabel">
                <i class="fas fa-shopping-cart me-2"></i>Shopping Cart
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="cart-items">
                <!-- Cart items will be loaded here -->
                <div class="text-center py-4">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Your cart is empty</p>
                </div>
            </div>
            <div class="cart-footer mt-auto">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <strong>Total: $<span id="cart-total">0.00</span></strong>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-dark" id="checkout-btn" disabled>
                        <i class="fas fa-credit-card me-2"></i>Checkout
                    </button>
                    <button class="btn btn-outline-dark" data-bs-dismiss="offcanvas">
                        Continue Shopping
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Wishlist Popup Modal -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="wishlistOffcanvas" aria-labelledby="wishlistOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="wishlistOffcanvasLabel">
                <i class="fas fa-heart me-2"></i>Wishlist
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="wishlist-items">
                <!-- Wishlist items will be loaded here -->
                <div class="text-center py-4">
                    <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Your wishlist is empty</p>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Cart and Wishlist JavaScript -->
    <script type="text/javascript">
        try {
            console.log('Starting cart and wishlist script...');
            
            // Cart and Wishlist functionality
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            
            console.log('Cart and Wishlist script loaded');

            // Test function to verify script is working
            window.testFunction = function() {
                console.log('Test function called successfully!');
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'JavaScript Working!',
                        text: 'JavaScript is working properly!',
                        timer: 2000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                } else {
                    alert('JavaScript is working!');
                }
            };
            
            console.log('testFunction defined:', typeof window.testFunction);

        // Initialize cart and wishlist
        function initCartAndWishlist() {
            updateCartCount();
            updateWishlistCount();
            loadCartItems();
            loadWishlistItems();
        }

        // Update cart count
        function updateCartCount() {
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cart-count').textContent = totalItems;
        }

        // Update wishlist count
        function updateWishlistCount() {
            document.getElementById('wishlist-count').textContent = wishlist.length;
        }

        // Add to cart (global function)
        window.addToCart = function(productId, productName, productPrice, productImage) {
            // Check if user is authenticated
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest
            
            try {
                console.log('Adding to cart:', { productId, productName, productPrice, productImage });
                const existingItem = cart.find(item => item.id === productId);
                
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push({
                        id: productId,
                        name: productName,
                        price: parseFloat(productPrice),
                        image: productImage,
                        quantity: 1
                    });
                }
                
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
                loadCartItems();
                
                // Show success message
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Cart!',
                        text: productName + ' has been added to your cart.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Cart!',
                            text: productName + ' has been added to your cart.',
                            timer: 2000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    } else {
                        alert('Added to cart: ' + productName);
                    }
                }
            } catch (error) {
                console.error('Error adding to cart:', error);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Error adding to cart. Please try again.',
                        timer: 3000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                } else {
                    alert('Error adding to cart. Please try again.');
                }
            }
        }

        // Add to wishlist (global function)
        window.addToWishlist = function(productId, productName, productPrice, productImage) {
            // Check if user is authenticated
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest
            
            try {
                console.log('Adding to wishlist:', { productId, productName, productPrice, productImage });
                const existingItem = wishlist.find(item => item.id === productId);
                
                if (!existingItem) {
                    wishlist.push({
                        id: productId,
                        name: productName,
                        price: parseFloat(productPrice),
                        image: productImage
                    });
                    
                    localStorage.setItem('wishlist', JSON.stringify(wishlist));
                    updateWishlistCount();
                    loadWishlistItems();
                    
                    // Show success message
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Wishlist!',
                            text: productName + ' has been added to your wishlist.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Added to Wishlist!',
                                text: productName + ' has been added to your wishlist.',
                                timer: 2000,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end'
                            });
                        } else {
                            alert('Added to wishlist: ' + productName);
                        }
                    }
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Already in Wishlist',
                            text: productName + ' is already in your wishlist.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Already in Wishlist',
                                text: productName + ' is already in your wishlist.',
                                timer: 2000,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end'
                            });
                        } else {
                            alert(productName + ' is already in your wishlist.');
                        }
                    }
                }
            } catch (error) {
                console.error('Error adding to wishlist:', error);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Error adding to wishlist. Please try again.',
                        timer: 3000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                } else {
                    alert('Error adding to wishlist. Please try again.');
                }
            }
        }

        // Remove from cart (global function)
        window.removeFromCart = function(productId) {
            cart = cart.filter(item => item.id !== productId);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            loadCartItems();
        }

        // Remove from wishlist (global function)
        window.removeFromWishlist = function(productId) {
            wishlist = wishlist.filter(item => item.id !== productId);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            updateWishlistCount();
            loadWishlistItems();
        }

        // Update cart quantity (global function)
        window.updateCartQuantity = function(productId, quantity) {
            const item = cart.find(item => item.id === productId);
            if (item) {
                if (quantity <= 0) {
                    removeFromCart(productId);
                } else {
                    item.quantity = quantity;
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCartCount();
                    loadCartItems();
                }
            }
        }

        // Load cart items
        function loadCartItems() {
            const cartItemsContainer = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('checkout-btn');
            
            if (cart.length === 0) {
                cartItemsContainer.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Your cart is empty</p>
                    </div>
                `;
                cartTotal.textContent = '0.00';
                checkoutBtn.disabled = true;
            } else {
                let total = 0;
                let itemsHtml = '';
                
                cart.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    
                    itemsHtml += `
                        <div class="cart-item d-flex align-items-center mb-3 p-3 border rounded">
                            <img src="${item.image}" alt="${item.name}" class="me-3" style="width: 60px; height: 60px; object-fit: contain;">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">${item.name}</h6>
                                <p class="text-muted mb-1">$${item.price.toFixed(2)}</p>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="updateCartQuantity(${item.id}, ${item.quantity - 1})">-</button>
                                    <span class="mx-2">${item.quantity}</span>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="updateCartQuantity(${item.id}, ${item.quantity + 1})">+</button>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${item.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                });
                
                cartItemsContainer.innerHTML = itemsHtml;
                cartTotal.textContent = total.toFixed(2);
                checkoutBtn.disabled = false;
            }
        }

        // Load wishlist items
        function loadWishlistItems() {
            const wishlistItemsContainer = document.getElementById('wishlist-items');
            
            if (wishlist.length === 0) {
                wishlistItemsContainer.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Your wishlist is empty</p>
                    </div>
                `;
            } else {
                let itemsHtml = '';
                
                wishlist.forEach(item => {
                    itemsHtml += `
                        <div class="wishlist-item d-flex align-items-center mb-3 p-3 border rounded">
                            <img src="${item.image}" alt="${item.name}" class="me-3" style="width: 60px; height: 60px; object-fit: contain;">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">${item.name}</h6>
                                <p class="text-muted mb-1">$${item.price.toFixed(2)}</p>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <button class="btn btn-sm btn-dark" onclick="addToCart(${item.id}, '${item.name}', ${item.price}, '${item.image}')">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="removeFromWishlist(${item.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;
                });
                
                wishlistItemsContainer.innerHTML = itemsHtml;
            }
        }


        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing cart and wishlist...');
            initCartAndWishlist();
            
            // Also initialize toggle buttons here
            const cartToggle = document.getElementById('cart-toggle');
            const wishlistToggle = document.getElementById('wishlist-toggle');
            
            console.log('Cart toggle element:', cartToggle);
            console.log('Wishlist toggle element:', wishlistToggle);
            
            if (cartToggle) {
                cartToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Cart toggle clicked');
                    const cartOffcanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));
                    cartOffcanvas.show();
                });
            }
            
            if (wishlistToggle) {
                wishlistToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Wishlist toggle clicked');
                    const wishlistOffcanvas = new bootstrap.Offcanvas(document.getElementById('wishlistOffcanvas'));
                    wishlistOffcanvas.show();
                });
            }
            
            // Test if functions are available globally
            console.log('addToCart function available:', typeof window.addToCart);
            console.log('addToWishlist function available:', typeof window.addToWishlist);
        });
        
        } catch (error) {
            console.error('Error in cart and wishlist script:', error);
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error loading cart and wishlist functionality: ' + error.message,
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            } else {
                alert('Error loading cart and wishlist functionality: ' + error.message);
            }
        }
    </script>

    <!-- Working Cart and Wishlist Functions -->
    <script>
        // Simple cart and wishlist functions that work
        window.addToCart = function(productId, productName, productPrice, productImage) {
            // Check if user is authenticated
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest
            
            console.log('Adding to cart:', {productId, productName, productPrice, productImage});
            
            // Get existing cart from localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            
            // Check if item already exists
            const existingItem = cart.find(item => item.id === productId);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: parseFloat(productPrice),
                    image: productImage,
                    quantity: 1
                });
            }
            
            // Save to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));
            
            // Update cart count
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.textContent = totalItems;
            }
            
            // Show success message
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Cart!',
                    text: productName + ' has been added to your cart.',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                // Fallback notification
                showNotification('Added to cart: ' + productName, 'success');
            }
        };
        
        window.addToWishlist = function(productId, productName, productPrice, productImage) {
            // Check if user is authenticated
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest
            
            console.log('Adding to wishlist:', {productId, productName, productPrice, productImage});
            
            // Get existing wishlist from localStorage
            let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            
            // Check if item already exists
            const existingItem = wishlist.find(item => item.id === productId);
            
            if (!existingItem) {
                wishlist.push({
                    id: productId,
                    name: productName,
                    price: parseFloat(productPrice),
                    image: productImage
                });
                
                // Save to localStorage
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
                
                // Update wishlist count
                const wishlistCount = document.getElementById('wishlist-count');
                if (wishlistCount) {
                    wishlistCount.textContent = wishlist.length;
                }
                
                // Show success message
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Wishlist!',
                        text: productName + ' has been added to your wishlist.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    showNotification('Added to wishlist: ' + productName, 'success');
                }
            } else {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Already in Wishlist',
                        text: productName + ' is already in your wishlist.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    showNotification(productName + ' is already in your wishlist.', 'info');
                }
            }
        };
        
        // Function to open cart popup
        window.openCartPopup = function() {
            console.log('Opening cart popup');
            
            // Wait for DOM to be ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    openCartPopup();
                });
                return;
            }
            
            let cartElement = document.getElementById('cartOffcanvas');
            console.log('Cart element found:', !!cartElement);
            
            // If element doesn't exist, create it
            if (!cartElement) {
                console.log('Cart element not found, creating it...');
                cartElement = createCartPopup();
            }
            
            // Check Bootstrap availability
            if (typeof bootstrap === 'undefined') {
                console.error('Bootstrap not loaded, trying to load...');
                // Try to load Bootstrap dynamically
                loadBootstrap().then(() => {
                    if (cartElement) {
                        const cartOffcanvas = new bootstrap.Offcanvas(cartElement);
                        cartOffcanvas.show();
                    }
                });
                return;
            }
            
            if (cartElement) {
                try {
                    if (typeof bootstrap !== 'undefined') {
                        const cartOffcanvas = new bootstrap.Offcanvas(cartElement);
                        cartOffcanvas.show();
                        console.log('Cart popup opened successfully');
                    } else {
                        // Fallback: show popup without Bootstrap
                        cartElement.style.display = 'block';
                        cartElement.style.position = 'fixed';
                        cartElement.style.top = '0';
                        cartElement.style.right = '0';
                        cartElement.style.width = '400px';
                        cartElement.style.height = '100vh';
                        cartElement.style.backgroundColor = 'white';
                        cartElement.style.zIndex = '9999';
                        cartElement.style.boxShadow = '-5px 0 15px rgba(0,0,0,0.1)';
                        console.log('Cart popup opened with fallback method');
                    }
                } catch (error) {
                    console.error('Error opening cart popup:', error);
                }
            } else {
                console.error('Cart popup element not found');
            }
        };
        
        // Function to open wishlist popup
        window.openWishlistPopup = function() {
            console.log('Opening wishlist popup');
            
            // Wait for DOM to be ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    openWishlistPopup();
                });
                return;
            }
            
            let wishlistElement = document.getElementById('wishlistOffcanvas');
            console.log('Wishlist element found:', !!wishlistElement);
            
            // If element doesn't exist, create it
            if (!wishlistElement) {
                console.log('Wishlist element not found, creating it...');
                wishlistElement = createWishlistPopup();
            }
            
            // Check Bootstrap availability
            if (typeof bootstrap === 'undefined') {
                console.error('Bootstrap not loaded, trying to load...');
                // Try to load Bootstrap dynamically
                loadBootstrap().then(() => {
                    if (wishlistElement) {
                        const wishlistOffcanvas = new bootstrap.Offcanvas(wishlistElement);
                        wishlistOffcanvas.show();
                    }
                });
                return;
            }
            
            if (wishlistElement) {
                try {
                    if (typeof bootstrap !== 'undefined') {
                        const wishlistOffcanvas = new bootstrap.Offcanvas(wishlistElement);
                        wishlistOffcanvas.show();
                        console.log('Wishlist popup opened successfully');
                    } else {
                        // Fallback: show popup without Bootstrap
                        wishlistElement.style.display = 'block';
                        wishlistElement.style.position = 'fixed';
                        wishlistElement.style.top = '0';
                        wishlistElement.style.right = '0';
                        wishlistElement.style.width = '400px';
                        wishlistElement.style.height = '100vh';
                        wishlistElement.style.backgroundColor = 'white';
                        wishlistElement.style.zIndex = '9999';
                        wishlistElement.style.boxShadow = '-5px 0 15px rgba(0,0,0,0.1)';
                        console.log('Wishlist popup opened with fallback method');
                    }
                } catch (error) {
                    console.error('Error opening wishlist popup:', error);
                }
            } else {
                console.error('Wishlist popup element not found');
            }
        };
        
        // Function to create cart popup if it doesn't exist
        function createCartPopup() {
            const cartHtml = `
                <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="cartOffcanvasLabel">
                            <i class="fas fa-shopping-cart me-2"></i>Shopping Cart
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div id="cart-items">
                            <div class="text-center py-4">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Your cart is empty</p>
                            </div>
                        </div>
                        <div class="cart-footer mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <strong>Total: $<span id="cart-total">0.00</span></strong>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-dark" id="checkout-btn" disabled>
                                    <i class="fas fa-credit-card me-2"></i>Checkout
                                </button>
                                <button class="btn btn-outline-dark" data-bs-dismiss="offcanvas">
                                    Continue Shopping
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', cartHtml);
            return document.getElementById('cartOffcanvas');
        }
        
        // Function to load Bootstrap dynamically
        function loadBootstrap() {
            return new Promise((resolve, reject) => {
                if (typeof bootstrap !== 'undefined') {
                    resolve();
                    return;
                }
                
                // Try to load Bootstrap from CDN
                const script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js';
                script.onload = () => {
                    console.log('Bootstrap loaded successfully');
                    resolve();
                };
                script.onerror = () => {
                    console.error('Failed to load Bootstrap');
                    reject();
                };
                document.head.appendChild(script);
            });
        }
        
        // Function to create wishlist popup if it doesn't exist
        function createWishlistPopup() {
            const wishlistHtml = `
                <div class="offcanvas offcanvas-end" tabindex="-1" id="wishlistOffcanvas" aria-labelledby="wishlistOffcanvasLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="wishlistOffcanvasLabel">
                            <i class="fas fa-heart me-2"></i>Wishlist
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div id="wishlist-items">
                            <div class="text-center py-4">
                                <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Your wishlist is empty</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', wishlistHtml);
            return document.getElementById('wishlistOffcanvas');
        }
        
        // Custom notification function
        function showNotification(message, type = 'success') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'success' ? 'success' : 'info'} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            // Add to page
            document.body.appendChild(notification);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 3000);
        }
        
        // Initialize popup functions when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, popup functions ready');
            console.log('Cart element exists:', !!document.getElementById('cartOffcanvas'));
            console.log('Wishlist element exists:', !!document.getElementById('wishlistOffcanvas'));
            console.log('Bootstrap available:', typeof bootstrap !== 'undefined');
            
            // Test if elements are actually in the DOM
            const cartElement = document.getElementById('cartOffcanvas');
            const wishlistElement = document.getElementById('wishlistOffcanvas');
            
            if (cartElement) {
                console.log('Cart element found:', cartElement);
            } else {
                console.error('Cart element NOT found in DOM');
            }
            
            if (wishlistElement) {
                console.log('Wishlist element found:', wishlistElement);
            } else {
                console.error('Wishlist element NOT found in DOM');
            }
        });
        
        console.log('Working cart and wishlist functions defined');
    </script>

</html>