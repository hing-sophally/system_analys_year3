    <!-- Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-store me-2"></i>Ecommerce Store
                    </h5>
                    <p class="">
                        Your trusted online shopping destination. We offer quality products at competitive prices with fast and reliable delivery.
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('frontend.home') }}" class=" text-decoration-none">Home</a></li>
                        <li><a href="{{ route('frontend.about') }}" class=" text-decoration-none">About Us</a></li>
                        <li><a href="{{ route('frontend.contact') }}" class=" text-decoration-none">Contact</a></li>
                        <li><a href="{{ route('frontend.products') }}" class=" text-decoration-none">Products</a></li>
                    </ul>
                </div>
                
                <!-- Customer Service -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Customer Service</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class=" text-decoration-none">Help Center</a></li>
                        <li><a href="#" class=" text-decoration-none">Shipping Info</a></li>
                        <li><a href="#" class=" text-decoration-none">Returns</a></li>
                        <li><a href="#" class=" text-decoration-none">Size Guide</a></li>
                        <li><a href="#" class=" text-decoration-none">Track Your Order</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Contact Information</h6>
                    <div class="contact-info">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt me-3"></i>
                            <span class="">123 Business Street, City, State 12345</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-phone me-3"></i>
                            <span class="">+1 (555) 123-4567</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-envelope me-3"></i>
                            <span class="">info@ecommercestore.com</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock me-3"></i>
                            <span class="">Mon-Fri: 9AM-6PM</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Newsletter Subscription -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="newsletter-section bg-dark p-4 rounded">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h6 class="text-white mb-0">Subscribe to our newsletter</h6>
                                <p class="text-white-50 mb-0">Get the latest updates on new products and exclusive offers!</p>
                            </div>
                            <div class="col-md-6">
                                <form class="d-flex">
                                    <input type="email" class="form-control me-2" placeholder="Enter your email">
                                    <button class="btn btn-light" type="submit">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Footer -->
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class=" mb-0">&copy; {{ date('Y') }} Ecommerce Store. All rights reserved.</p>
                </div>
                <div class="col-md-6">
                    <div class="payment-methods text-end">
                        <span class=" me-2">We Accept:</span>
                        <i class="fab fa-cc-visa me-2"></i>
                        <i class="fab fa-cc-mastercard me-2"></i>
                        <i class="fab fa-cc-paypal me-2"></i>
                        <i class="fab fa-cc-amex"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="btn btn-dark position-fixed" style="bottom: 20px; right: 20px; display: none; z-index: 1000;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @stack('scripts')
    
    <script>
        // Back to top functionality
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#backToTop').fadeIn();
            } else {
                $('#backToTop').fadeOut();
            }
        });
        
        $('#backToTop').click(function() {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
        
        // Auto-hide alerts
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>
</body>
</html>
