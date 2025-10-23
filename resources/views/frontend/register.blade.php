@extends('frontend.layouts.app')

@section('title', 'Register - Ecommerce Store')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Create Account</h1>
                <p class="lead">Join our community today</p>
            </div>
        </div>
    </div>
</section>

<!-- Register Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h3 class="fw-bold mb-4 text-center">Sign Up</h3>
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-primary">Terms and Conditions</a>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-dark btn-lg w-100">Create Account</button>
                        </form>
                        <div class="text-center mt-4">
                            <p class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-dark">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
