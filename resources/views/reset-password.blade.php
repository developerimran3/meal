<!DOCTYPE html>
<html lang="en">


<head>

    @include('layouts.components.main-header')
    <title>Reset Password</title>
</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <div class="authentication-header"></div>
        <div class="authentication-reset-password d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-lg-5 border-end">
                                <div class="card-body">
                                    <div class="p-5">
                                        <div class="text-start">
                                            <img src="assets/images/logo-img.png" width="180" alt="">
                                        </div>
                                        <h4 class="mt-5 font-weight-bold">Genrate New Password</h4>
                                        <p class="text-muted">We received your reset password request. Please enter your
                                            new password!</p>

                                        <form action="{{ route('reset.password') }}" method="POST">
                                            @csrf
                                            <div class="mb-3 mt-5">
                                                <label class="form-label">Your OTP</label>
                                                <input type="number" name="otp" class="form-control"
                                                    placeholder="Enter OTP" value="{{ old('otp') }}" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">New Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Enter new password" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" name="password_confirmation" class="form-control"
                                                    placeholder="Confirm password" />
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary">Change Password</button>
                                                <a href="/login" class="btn btn-light"><i
                                                        class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <img src="{{ asset('assets/images/login-images/forgot-password-frent-img.jpg') }}"
                                    class="card-img login-img h-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->
</body>
@include('layouts.components.footer')

</html>
