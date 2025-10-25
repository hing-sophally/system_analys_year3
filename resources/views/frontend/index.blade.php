@extends('frontend.layouts.app')

@section('title', 'Home - Ecommerce Store')

@section('content')
<!-- Image Slider Banner -->
<section class="hero-slider">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="hero-slide text-white d-flex align-items-center" style="height: 500px; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1595665593673-bf1ad72905c0?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8Y2xvdGhpbmclMjBzdG9yZXxlbnwwfHwwfHx8MA%3D%3D&fm=jpg&q=60&w=3000') center/cover;">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h1 class="display-4 fw-bold mb-4">Welcome to Our Fashion Store</h1>
                                <p class="lead mb-4">Discover the latest trends in clothing and accessories. Shop with confidence and enjoy fast, reliable delivery.</p>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('frontend.products') }}" class="btn btn-light btn-lg">Shop Now</a>
                                    <a href="{{ route('frontend.about') }}" class="btn btn-outline-light btn-lg">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero-slide text-white d-flex align-items-center" style="height: 500px; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://img.freepik.com/premium-photo/clothes-interior-fashion-shop_88135-23247.jpg') center/cover;">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h1 class="display-4 fw-bold mb-4">Fashion & Style Collection</h1>
                                <p class="lead mb-4">Explore our curated collection of trendy clothing and accessories. From casual wear to formal attire, we have everything you need.</p>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('frontend.products') }}" class="btn btn-outline-light btn-lg">View Products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero-slide text-white d-flex align-items-center" style="height: 500px; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://retaildesignblog.net/wp-content/uploads/2013/09/PREVIEW-shoe-store-by-in-between-Design-Office-Hong-Kong-02.jpg') center/cover;">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h1 class="display-4 fw-bold mb-4">Footwear & Accessories</h1>
                                <p class="lead mb-4">Step up your style with our premium footwear collection. From casual sneakers to elegant dress shoes, find the perfect pair.</p>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('frontend.products') }}" class="btn btn-light btn-lg">Shop Footwear</a>
                                    <a href="{{ route('frontend.about') }}" class="btn btn-outline-light btn-lg">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-box p-4">
                    <div class="feature-icon bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-shipping-fast fa-lg"></i>
                    </div>
                    <h5 class="fw-bold">Free Shipping</h5>
                    <p class="text-muted">Free shipping on orders over $50</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-box p-4">
                    <div class="feature-icon bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-undo fa-lg"></i>
                    </div>
                    <h5 class="fw-bold">Easy Returns</h5>
                    <p class="text-muted">30-day return policy</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-box p-4">
                    <div class="feature-icon bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-headset fa-lg"></i>
                    </div>
                    <h5 class="fw-bold">24/7 Support</h5>
                    <p class="text-muted">Round-the-clock customer service</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-box p-4">
                    <div class="feature-icon bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-shield-alt fa-lg"></i>
                    </div>
                    <h5 class="fw-bold">Secure Payment</h5>
                    <p class="text-muted">Safe and secure transactions</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Category Tabs Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">Shop by Category</h2>
                <p class="text-muted">Browse our wide range of product categories</p>
            </div>
        </div>
        
        <!-- Category Tabs -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="category-tabs d-flex flex-wrap justify-content-center gap-3">
                    <button class="category-tab-btn active" data-category="all" data-products="{{ json_encode($featuredProducts) }}">
                        <div class="tab-icon">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <span>All Products</span>
                    </button>
                    @foreach($categories as $category)
                    <button class="category-tab-btn" data-category="{{ $category->id }}" data-products="{{ json_encode($category->products) }}">
                        <div class="tab-icon">
                            @if($category->image_url)
                                <img src="{{ $category->image_url ? (str_starts_with($category->image_url, 'http') ? $category->image_url : asset('storage/' . $category->image_url)) : asset('images/products/default.svg') }}" 
                                     alt="{{ $category->name }}" 
                                     class="category-tab-image">
                            @else
                                <i class="fas fa-tag"></i>
                            @endif
                        </div>
                        <span>{{ $category->name }}</span>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Search & Filter -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <!-- Search Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-search text-primary me-2 fs-5"></i>
                                    <h5 class="mb-0 fw-bold text-dark">Search Products</h5>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-md-10">
                                        <div class="input-group input-group-lg">
                                            <input type="text" class="form-control border-2" id="product-search" 
                                                   placeholder="Search by name or description..." 
                                                   autocomplete="off">
                                            <button class="btn btn-primary px-4" type="button" id="search-btn">
                                                <i class="fas fa-search me-2"></i>Search
                                            </button>
                                        </div>
                                        <small class="text-muted mt-2 d-block">
                                            <i class="fas fa-info-circle me-1"></i>Type to search products instantly
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filters Section -->
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-6">
                                <label class="form-label fw-semibold text-dark d-flex align-items-center">
                                    <i class="fas fa-tags text-success me-2"></i>Price Range
                                </label>
                                <select class="form-select border-2" id="price-filter">
                                    <option value="">All Prices</option>
                                    <option value="0-50">Under $50</option>
                                    <option value="50-100">$50 - $100</option>
                                    <option value="100-200">$100 - $200</option>
                                    <option value="200-500">$200 - $500</option>
                                    <option value="500+">$500+</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label class="form-label fw-semibold text-dark d-flex align-items-center">
                                    <i class="fas fa-sort text-warning me-2"></i>Sort By
                                </label>
                                <select class="form-select border-2" id="sort-filter">
                                    <option value="name">Name A-Z</option>
                                    <option value="price-low">Price: Low to High</option>
                                    <option value="price-high">Price: High to Low</option>
                                    <option value="stock-high">Stock: High to Low</option>
                                    <option value="newest">Newest First</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label class="form-label fw-semibold text-dark d-flex align-items-center">
                                    <i class="fas fa-filter text-info me-2"></i>Category
                                </label>
                                <select class="form-select border-2" id="category-filter">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label class="form-label fw-semibold text-dark d-flex align-items-center">
                                    <i class="fas fa-cog text-secondary me-2"></i>Actions
                                </label>
                                <button class="btn btn-outline-danger w-100" id="clear-filters">
                                    <i class="fas fa-times me-2"></i>Clear All Filters
                                </button>
                            </div>
                        </div>
                        
                        <!-- Active Filters Display -->
                        <div id="active-filters" class="mt-4 d-none">
                            <div class="bg-light rounded-3 p-3 border">
                                <div class="d-flex flex-wrap align-items-center">
                                    <span class="text-muted me-3 fw-semibold">
                                        <i class="fas fa-filter me-2"></i>Active filters:
                                    </span>
                                    <div id="filter-tags" class="d-flex flex-wrap gap-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">Featured Products</h2>
                <p class="text-muted">Check out our most popular items</p>
                <div id="search-results-info" class="alert alert-info d-none">
                    <i class="fas fa-info-circle me-2"></i>
                    <span id="results-count">0</span> products found
            </div>
        </div>
        </div>
        <div class="row" id="products-container">
            @forelse($featuredProducts as $product)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4 product-item" data-category="{{ $product->category_id }}">
                <div class="card product-card h-100 shadow-sm">
                    <div class="position-relative">
                        <div class="product-image-container" style="height: 250px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                            <img src="{{ $product->image_url ? (str_starts_with($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url)) : asset('images/products/default.svg') }}" 
                                 class="card-img-top product-image" 
                                 alt="{{ $product->name }}" 
                                 style="height: 100%; width: 100%; object-fit: contain; transition: opacity 0.3s ease;"
                                 loading="lazy"
                                 onload="this.style.opacity='1'; this.parentElement.querySelector('.image-placeholder').style.display='none';"
                                 onerror="this.style.display='none'; this.parentElement.querySelector('.image-placeholder').style.display='flex';">
                            <div class="image-placeholder" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <div class="text-center">
                                    <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                    <p class="text-muted small mb-0">No Image</p>
                                </div>
                            </div>
                        </div>
                        <div class="product-badges position-absolute top-0 end-0 p-2">
                            @if($product->discount && $product->discount > 0)
                                <span class="badge bg-danger">
                                    <i class="fas fa-tag me-1"></i>{{ $product->discount }}% OFF
                                </span>
                            @endif
                        </div>
                        <div class="product-actions position-absolute top-50 start-50 translate-middle">
                            <button class="btn btn-light btn-sm me-2" title="Quick View">
                                <i class="fas fa-eye"></i>
                            </button>
                            @php
                                $finalPrice = $product->discount && $product->discount > 0 
                                    ? $product->price - ($product->price * $product->discount / 100)
                                    : $product->price;
                            @endphp
                            <button class="btn btn-light btn-sm me-2" title="Add to Wishlist" 
                                onclick="addToWishlist({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $finalPrice }}, '{{ $product->image_url ? (str_starts_with($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url)) : asset('images/products/default.svg') }}')">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="btn btn-dark btn-sm" title="Add to Cart" 
                                onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $finalPrice }}, '{{ $product->image_url ? (str_starts_with($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url)) : asset('images/products/default.svg') }}')"
                                {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if($product->discount && $product->discount > 0)
                                        @php
                                            $discountedPrice = $product->price - ($product->price * $product->discount / 100);
                                        @endphp
                                        <div class="d-flex flex-column">
                                            <span class="text-muted text-decoration-line-through small">${{ number_format($product->price, 2) }}</span>
                                            <span class="h5 text-danger fw-bold mb-0">${{ number_format($discountedPrice, 2) }}</span>
                                        </div>
                                    @else
                                        <span class="h6 text-dark">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <small class="text-muted ms-1">({{ rand(10, 100) }})</small>
                                </div>
                            </div>
                            @if($product->stock <= 0)
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle me-1"></i>Out of Stock
                                </span>
                            @elseif($product->stock < 10)
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Low Stock ({{ $product->stock }} units)
                                </span>
                            @else
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i>In Stock
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No featured products found</h4>
                <p class="text-muted">Check back later for new products!</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('frontend.products') }}" class="btn btn-dark btn-lg">View All Products</a>
        </div>
        
        <!-- Ensure cart and wishlist functions are available -->
        <script>
            // Define functions immediately when page loads
            if (typeof window.addToCart === 'undefined') {
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
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        // Fallback notification
                        showNotification('Added to cart: ' + productName, 'success');
                    }
                };
            }
            
            if (typeof window.addToWishlist === 'undefined') {
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
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            showNotification('Added to wishlist: ' + productName, 'success');
                        }
                    } else {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Already in Wishlist!',
                                text: productName + ' is already in your wishlist.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            showNotification(productName + ' is already in your wishlist.', 'info');
                        }
                    }
                };
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
            
            console.log('Cart and wishlist functions defined on page:', typeof window.addToCart, typeof window.addToWishlist);
        </script>
    </div>
</section>



@endsection

@push('styles')
<style>
/* Hero Slider Styles */
.hero-slider {
    position: relative;
}

.hero-slide {
    min-height: 500px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.carousel-indicators {
    bottom: 20px;
}

.carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.5);
    border: none;
    margin: 0 5px;
}

.carousel-indicators button.active {
    background-color: #fff;
}

.carousel-control-prev,
.carousel-control-next {
    width: 50px;
    height: 50px;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
}

.carousel-control-prev {
    left: 20px;
}

.carousel-control-next {
    right: 20px;
}

/* Product Cards */
.product-card {
    transition: transform 0.3s ease;
    border: none;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-actions {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-actions {
    opacity: 1;
}

/* Category Tabs */
.category-tabs {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin-bottom: 30px;
}

.category-tab-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 15px 20px;
    border: 2px solid #dee2e6;
    background: #fff;
    border-radius: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 120px;
    text-decoration: none;
    color: #6c757d;
}

.category-tab-btn:hover {
    border-color: #000;
    background: #f8f9fa;
    color: #000;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.category-tab-btn.active {
    border-color: #000;
    background: #000;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.tab-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.category-tab-btn:hover .tab-icon {
    background: rgba(0, 0, 0, 0.1);
}

.category-tab-btn.active .tab-icon {
    background: rgba(255, 255, 255, 0.2);
}

.category-tab-image {
    width: 30px;
    height: 30px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid rgba(0, 0, 0, 0.1);
}

.category-tab-btn span {
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    line-height: 1.2;
}

/* Product Filter Animation */
.product-item {
    transition: all 0.3s ease;
    display: inline-block;
    vertical-align: top;
}

/* Ensure consistent card sizing */
.product-card {
    width: 100%;
    min-height: 400px;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
}

.product-card .card-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

/* Simple Stock Status - Just disable buttons for out of stock */
.product-card .product-actions button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Enhanced Search & Filter Styling */
.input-group-lg .form-control {
    border-radius: 0.5rem 0 0 0.5rem;
    border-right: none;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.input-group-lg .form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    z-index: 3;
}

#search-btn {
    border-radius: 0 0.5rem 0.5rem 0;
    border-left: none;
    border: 2px solid #0d6efd;
    font-weight: 600;
    transition: all 0.3s ease;
}

#search-btn:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
    transform: translateY(-1px);
}

.form-select {
    border: 2px solid #e9ecef;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    font-weight: 500;
}

.form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.form-label {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    color: #495057;
}

/* Active Filters Styling */
#active-filters .bg-light {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
    border: 1px solid #dee2e6;
}

#filter-tags .badge {
    font-size: 0.85rem;
    border-radius: 1.5rem;
    padding: 0.5rem 1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

#filter-tags .badge:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

/* Search Results Info */
#search-results-info {
    border-radius: 0.5rem;
    border: none;
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Card Styling */
.card {
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.12);
    transform: translateY(-2px);
}

/* Button Styling */
#clear-filters {
    border: 2px solid #dc3545;
    font-weight: 600;
    transition: all 0.3s ease;
}

#clear-filters:hover {
    background-color: #dc3545;
    border-color: #dc3545;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
}

/* Loading Animation */
.search-loading {
    position: relative;
}

.search-loading::after {
    content: '';
    position: absolute;
    top: 50%;
    right: 1rem;
    width: 1rem;
    height: 1rem;
    border: 2px solid #f3f3f3;
    border-top: 2px solid #0d6efd;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .input-group-lg .form-control {
        font-size: 1rem;
        padding: 0.75rem 1rem;
    }
    
    #search-btn {
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
    }
    
    .form-select {
        font-size: 1rem;
        padding: 0.75rem 1rem;
    }
    
    #active-filters .bg-light {
        padding: 1rem;
    }
    
    #filter-tags .badge {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
    }
    
    .form-label {
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .input-group-lg {
        flex-direction: column;
    }
    
    .input-group-lg .form-control {
        border-radius: 0.5rem;
        border-right: 2px solid #e9ecef;
        margin-bottom: 0.5rem;
    }
    
    #search-btn {
        border-radius: 0.5rem;
        border-left: 2px solid #0d6efd;
        width: 100%;
    }
}

.product-item.hidden {
    opacity: 0;
    transform: scale(0.8);
    pointer-events: none;
}

.product-item.visible {
    opacity: 1;
    transform: scale(1);
    pointer-events: auto;
}

/* Feature Boxes */
.feature-box {
    transition: transform 0.3s ease;
    padding: 20px;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.feature-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-slide {
        height: 400px !important;
        text-align: center;
    }
    
    .hero-slide .display-4 {
        font-size: 2rem;
    }
    
    .hero-slide .lead {
        font-size: 1rem;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 40px;
        height: 40px;
    }
    
    .carousel-control-prev {
        left: 10px;
    }
    
    .carousel-control-next {
        right: 10px;
    }
    
    .category-card {
        margin-bottom: 20px;
    }
    
    .category-image img {
        width: 80px !important;
        height: 80px !important;
    }
}

@media (max-width: 576px) {
    .hero-slide {
        height: 350px !important;
    }
    
    .hero-slide .display-4 {
        font-size: 1.5rem;
    }
    
    .hero-slide .btn {
        font-size: 0.9rem;
        padding: 8px 16px;
    }
    
    .category-image img {
        width: 60px !important;
        height: 60px !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Smooth image loading
    $('.product-image').each(function() {
        const img = $(this);
        const container = img.closest('.product-image-container');
        const placeholder = container.find('.image-placeholder');
        
        console.log('Processing image:', img.attr('src'));
        
        // Set initial opacity
        img.css('opacity', '0');
        
        // Handle image load
        img.on('load', function() {
            console.log('Image loaded successfully:', img.attr('src'));
            $(this).css('opacity', '1').addClass('loaded');
            placeholder.fadeOut(300);
        });
        
        // Handle image error
        img.on('error', function() {
            console.log('Image failed to load:', img.attr('src'));
            $(this).hide();
            placeholder.fadeIn(300);
        });
        
        // If image is already loaded (cached), show it immediately
        if (img[0].complete && img[0].naturalHeight !== 0) {
            console.log('Image already loaded (cached):', img.attr('src'));
            img.css('opacity', '1').addClass('loaded');
            placeholder.hide();
        }
    });
    
    // Product card hover effects for buttons
    $('.product-card .btn').hover(
        function() {
            $(this).addClass('shadow');
        },
        function() {
            $(this).removeClass('shadow');
        }
    );
    
    // Image hover effects
    $('.product-image-container').hover(
        function() {
            $(this).find('.product-image').css('transform', 'scale(1.05)');
        },
        function() {
            $(this).find('.product-image').css('transform', 'scale(1)');
        }
    );
    
    // Category tab functionality
    $('.category-tab-btn').click(function() {
        const categoryId = $(this).data('category');
        const products = $(this).data('products');

        // Remove active class from all tabs
        $('.category-tab-btn').removeClass('active');
        // Add active class to clicked tab
        $(this).addClass('active');

        // Filter products based on category
        if (categoryId === 'all') {
            // Show all products
            $('.product-item').removeClass('hidden').addClass('visible');
        } else {
            // Hide all products first
            $('.product-item').removeClass('visible').addClass('hidden');

            // Show products from selected category
            $('.product-item[data-category="' + categoryId + '"]').removeClass('hidden').addClass('visible');
        }

        // Update products count
        const visibleProducts = $('.product-item.visible').length;
        console.log('Showing ' + visibleProducts + ' products for category: ' + categoryId);
        updateSearchResults(visibleProducts);
    });

    // Search functionality with debounce
    let searchTimeout;
    $('#product-search').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            filterProducts();
        }, 300);
    });

    // Price filter functionality
    $('#price-filter').change(function() {
        filterProducts();
    });

    // Category filter functionality
    $('#category-filter').change(function() {
        filterProducts();
    });

    // Sort functionality
    $('#sort-filter').change(function() {
        sortProducts();
    });

    // Clear filters functionality
    $('#clear-filters').click(function() {
        $('#product-search').val('');
        $('#price-filter').val('');
        $('#category-filter').val('');
        $('#sort-filter').val('name');
        $('.product-item').removeClass('hidden').addClass('visible');
        updateSearchResults($('.product-item.visible').length);
        updateActiveFilters();
    });

    // Search button functionality
    $('#search-btn').click(function() {
        filterProducts();
    });

    // Enter key search
    $('#product-search').keypress(function(e) {
        if (e.which === 13) {
            e.preventDefault();
            filterProducts();
        }
    });

    // Filter products function
    function filterProducts() {
        const searchTerm = $('#product-search').val().toLowerCase().trim();
        const priceFilter = $('#price-filter').val();
        const categoryFilter = $('#category-filter').val();
        
        $('.product-item').each(function() {
            const $item = $(this);
            const productName = $item.find('.card-title').text().toLowerCase();
            const productDescription = $item.find('.card-text').text().toLowerCase();
            const productPrice = parseFloat($item.find('.h6').text().replace(/[$,]/g, ''));
            const productCategory = $item.data('category');
            
            let showItem = true;
            
            // Search filter - improved logic
            if (searchTerm) {
                const searchWords = searchTerm.split(' ').filter(word => word.length > 0);
                const searchMatch = searchWords.every(word => 
                    productName.includes(word) || productDescription.includes(word)
                );
                if (!searchMatch) showItem = false;
            }
            
            // Price filter - corrected logic
            if (priceFilter && showItem) {
                switch(priceFilter) {
                    case '0-50':
                        if (productPrice >= 50) showItem = false;
                        break;
                    case '50-100':
                        if (productPrice < 50 || productPrice >= 100) showItem = false;
                        break;
                    case '100-200':
                        if (productPrice < 100 || productPrice >= 200) showItem = false;
                        break;
                    case '200-500':
                        if (productPrice < 200 || productPrice >= 500) showItem = false;
                        break;
                    case '500+':
                        if (productPrice < 500) showItem = false;
                        break;
                }
            }
            
            // Category filter
            if (categoryFilter && showItem) {
                if (productCategory != categoryFilter) showItem = false;
            }
            
            if (showItem) {
                $item.removeClass('hidden').addClass('visible');
            } else {
                $item.removeClass('visible').addClass('hidden');
            }
        });
        
        const visibleCount = $('.product-item.visible').length;
        updateSearchResults(visibleCount);
        updateActiveFilters();
    }

    // Sort products function
    function sortProducts() {
        const sortBy = $('#sort-filter').val();
        const $container = $('#products-container');
        const $items = $('.product-item.visible').toArray();
        
        $items.sort(function(a, b) {
            const $a = $(a);
            const $b = $(b);
            
            switch(sortBy) {
                case 'name':
                    return $a.find('.card-title').text().localeCompare($b.find('.card-title').text());
                case 'price-low':
                    return parseFloat($a.find('.h6').text().replace(/[$,]/g, '')) - parseFloat($b.find('.h6').text().replace(/[$,]/g, ''));
                case 'price-high':
                    return parseFloat($b.find('.h6').text().replace(/[$,]/g, '')) - parseFloat($a.find('.h6').text().replace(/[$,]/g, ''));
                case 'stock-high':
                    const stockA = parseInt($a.find('.text-muted').text().match(/\d+/)?.[0] || 0);
                    const stockB = parseInt($b.find('.text-muted').text().match(/\d+/)?.[0] || 0);
                    return stockB - stockA;
                case 'newest':
                    return 0; // For now, keep original order
                default:
                    return 0;
            }
        });
        
        $container.empty();
        $items.forEach(function(item) {
            $container.append(item);
        });
    }

    // Update active filters display
    function updateActiveFilters() {
        const $activeFilters = $('#active-filters');
        const $filterTags = $('#filter-tags');
        const filters = [];
        
        // Search filter
        const searchTerm = $('#product-search').val().trim();
        if (searchTerm) {
            filters.push({
                type: 'search',
                label: `Search: "${searchTerm}"`,
                color: 'primary'
            });
        }
        
        // Price filter
        const priceFilter = $('#price-filter').val();
        if (priceFilter) {
            const priceLabels = {
                '0-50': 'Under $50',
                '50-100': '$50 - $100',
                '100-200': '$100 - $200',
                '200-500': '$200 - $500',
                '500+': '$500+'
            };
            filters.push({
                type: 'price',
                label: `Price: ${priceLabels[priceFilter]}`,
                color: 'success'
            });
        }
        
        // Category filter
        const categoryFilter = $('#category-filter').val();
        if (categoryFilter) {
            const categoryName = $('#category-filter option:selected').text();
            filters.push({
                type: 'category',
                label: `Category: ${categoryName}`,
                color: 'info'
            });
        }
        
        // Display active filters
        if (filters.length > 0) {
            $filterTags.empty();
            filters.forEach(filter => {
                $filterTags.append(`
                    <span class="badge bg-${filter.color} px-3 py-2">
                        ${filter.label}
                        <button type="button" class="btn-close btn-close-white ms-2" 
                                onclick="removeFilter('${filter.type}')" 
                                style="font-size: 0.7em;"></button>
                    </span>
                `);
            });
            $activeFilters.removeClass('d-none');
        } else {
            $activeFilters.addClass('d-none');
        }
    }

    // Remove individual filter
    window.removeFilter = function(type) {
        switch(type) {
            case 'search':
                $('#product-search').val('');
                break;
            case 'price':
                $('#price-filter').val('');
                break;
            case 'category':
                $('#category-filter').val('');
                break;
        }
        filterProducts();
    };

    // Update search results info
    function updateSearchResults(count) {
        const $info = $('#search-results-info');
        const $count = $('#results-count');
        
        if (count < $('.product-item').length) {
            $count.text(count);
            $info.removeClass('d-none');
        } else {
            $info.addClass('d-none');
        }
    }
});
</script>
@endpush


