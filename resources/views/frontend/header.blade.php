<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Ecommerce Store')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold" href="{{ route('frontend.home') }}">
                <i class="fas fa-store me-2"></i>Ecommerce Store
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.contact') }}">Contact</a>
                    </li>
                </ul>
                
                <!-- Search Bar -->
                <form class="d-flex me-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
                <!-- User Actions -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="openCartPopup()">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-dark ms-1" id="cart-count">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="openWishlistPopup()">
                            <i class="fas fa-heart"></i>
                            <span class="badge bg-dark ms-1" id="wishlist-count">0</span>
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
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    @if(isset($breadcrumbs))
    <nav aria-label="breadcrumb" class="bg-light py-2">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                @foreach($breadcrumbs as $breadcrumb)
                    @if($loop->last)
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></li>
                    @endif
                @endforeach
            </ol>
        </div>
    </nav>
    @endif

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <div class="container">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
            <div class="container">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Popup Functions -->
    <script>
        // Define popup functions with robust error handling
        if (typeof window.openCartPopup === 'undefined') {
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
                            // Load cart items when popup opens
                            loadCartItems();
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
                            // Load cart items when popup opens
                            loadCartItems();
                        }
                    } catch (error) {
                        console.error('Error opening cart popup:', error);
                    }
                } else {
                    console.error('Cart popup element not found');
                }
            };
        }
        
        if (typeof window.openWishlistPopup === 'undefined') {
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
                            // Load wishlist items when popup opens
                            loadWishlistItems();
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
                            // Load wishlist items when popup opens
                            loadWishlistItems();
                        }
                    } catch (error) {
                        console.error('Error opening wishlist popup:', error);
                    }
                } else {
                    console.error('Wishlist popup element not found');
                }
            };
        }
        
        // Helper functions for popup creation
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
        
        // Load cart items from localStorage
        function loadCartItems() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartItemsContainer = document.getElementById('cart-items');
            const cartTotalElement = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('checkout-btn');

            if (!cartItemsContainer) {
                console.error('Cart items container not found');
                return;
            }

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Your cart is empty</p>
                    </div>
                `;
                if (checkoutBtn) checkoutBtn.disabled = true;
                if (cartTotalElement) cartTotalElement.textContent = '0.00';
                return;
            }

            let total = 0;
            let itemsHtml = '';
            cart.forEach(item => {
                total += item.price * item.quantity;
                itemsHtml += `
                    <div class="d-flex align-items-center mb-3 p-2 cart-item">
                        <img src="${item.image}" alt="${item.name}" class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: contain;">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">${item.name}</h6>
                            <p class="text-muted mb-0">$${item.price.toFixed(2)} x ${item.quantity}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-outline-secondary me-1" onclick="updateCartQuantity(${item.id}, ${item.quantity - 1})">-</button>
                            <span class="mx-1">${item.quantity}</span>
                            <button class="btn btn-sm btn-outline-secondary me-1" onclick="updateCartQuantity(${item.id}, ${item.quantity + 1})">+</button>
                            <button class="btn btn-sm btn-danger" onclick="removeFromCart(${item.id})"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                `;
            });
            cartItemsContainer.innerHTML = itemsHtml;
            if (cartTotalElement) cartTotalElement.textContent = total.toFixed(2);
            if (checkoutBtn) {
                console.log('Checkout button found, setting up click handler');
                checkoutBtn.disabled = false;
                checkoutBtn.onclick = function() {
                    console.log('Checkout button clicked');
                    // Store cart data in session and redirect to checkout
                    const cart = JSON.parse(localStorage.getItem('cart')) || [];
                    console.log('Cart data:', cart);
                    
                    if (cart.length === 0) {
                        console.log('Cart is empty');
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Empty Cart',
                                text: 'Your cart is empty. Please add items before checkout.',
                                timer: 3000,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end'
                            });
                        } else {
                            alert('Your cart is empty. Please add items before checkout.');
                        }
                        return;
                    }
                    
                    console.log('Proceeding with checkout...');
                    // Show checkout coming soon message
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Checkout Coming Soon!',
                            text: 'Checkout functionality is currently under development. Thank you for your interest!',
                            timer: 3000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    } else {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Checkout Coming Soon!',
                                text: 'Checkout functionality is currently under development. Thank you for your interest!',
                                timer: 3000,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end'
                            });
                        } else {
                            alert('Checkout functionality is currently under development. Thank you for your interest!');
                        }
                    }
                };
            }
        }
        
        // Global checkout button handler (fallback)
        document.addEventListener('click', function(e) {
            if (e.target && e.target.id === 'checkout-btn') {
                console.log('Checkout button clicked via global handler');
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                
                if (cart.length === 0) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Empty Cart',
                            text: 'Your cart is empty. Please add items before checkout.',
                            timer: 3000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                        } else {
                            alert('Your cart is empty. Please add items before checkout.');
                        }
                    return;
                }
                
                // Show checkout coming soon message
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Checkout Coming Soon!',
                        text: 'Checkout functionality is currently under development. Thank you for your interest!',
                        timer: 3000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                } else {
                    alert('Checkout functionality is currently under development. Thank you for your interest!');
                }
            }
        });
        
        // Load wishlist items from localStorage
        function loadWishlistItems() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const wishlistItemsContainer = document.getElementById('wishlist-items');

            if (!wishlistItemsContainer) {
                console.error('Wishlist items container not found');
                return;
            }

            if (wishlist.length === 0) {
                wishlistItemsContainer.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Your wishlist is empty</p>
                    </div>
                `;
                return;
            }

            let itemsHtml = '';
            wishlist.forEach(item => {
                itemsHtml += `
                    <div class="d-flex align-items-center mb-3 p-2 wishlist-item">
                        <img src="${item.image}" alt="${item.name}" class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: contain;">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">${item.name}</h6>
                            <p class="text-muted mb-0">$${item.price.toFixed(2)}</p>
                        </div>
                        <button class="btn btn-sm btn-primary me-2" onclick="addToCart(${item.id}, '${item.name}', ${item.price}, '${item.image}')"><i class="fas fa-shopping-cart"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="removeFromWishlist(${item.id})"><i class="fas fa-trash"></i></button>
                    </div>
                `;
            });
            wishlistItemsContainer.innerHTML = itemsHtml;
        }
        
        // Cart and wishlist management functions
        window.addToCart = function(productId, productName, productPrice, productImage) {
            // Check if user is authenticated
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest
            
            try {
                console.log('Adding to cart:', { productId, productName, productPrice, productImage });
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
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
                    // Fallback notification
                    showNotification('Added to cart: ' + productName, 'success');
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
                    showNotification('Error adding to cart. Please try again.', 'error');
                }
            }
        };

        window.addToWishlist = function(productId, productName, productPrice, productImage) {
            // Check if user is authenticated
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest
            
            try {
                console.log('Adding to wishlist:', { productId, productName, productPrice, productImage });
                let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
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
                        showNotification('Added to wishlist: ' + productName, 'success');
                    }
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
                        showNotification(productName + ' is already in your wishlist.', 'info');
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
                    showNotification('Error adding to wishlist. Please try again.', 'error');
                }
            }
        };

        window.removeFromCart = function(productId) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const item = cart.find(item => item.id === productId);
            cart = cart.filter(item => item.id !== productId);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            loadCartItems();
            
            // Show removal notification
            if (item && typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Removed from Cart!',
                    text: item.name + ' has been removed from your cart.',
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            }
        };

        window.removeFromWishlist = function(productId) {
            let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const item = wishlist.find(item => item.id === productId);
            wishlist = wishlist.filter(item => item.id !== productId);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            updateWishlistCount();
            loadWishlistItems();
            
            // Show removal notification
            if (item && typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Removed from Wishlist!',
                    text: item.name + ' has been removed from your wishlist.',
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            }
        };

        window.updateCartQuantity = function(productId, quantity) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const item = cart.find(item => item.id === productId);
            if (item) {
                if (quantity <= 0) {
                    removeFromCart(productId);
                } else {
                    item.quantity = quantity;
                }
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            loadCartItems();
        };

        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.textContent = totalItems;
            }
        }

        function updateWishlistCount() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const wishlistCount = document.getElementById('wishlist-count');
            if (wishlistCount) {
                wishlistCount.textContent = wishlist.length;
            }
        }
        
        // Custom notification function (fallback when SweetAlert is not available)
        function showNotification(message, type = 'success') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
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
        
        console.log('Popup functions defined:', {
            openCartPopup: typeof window.openCartPopup,
            openWishlistPopup: typeof window.openWishlistPopup
        });
    </script>
