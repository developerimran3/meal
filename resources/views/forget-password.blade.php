<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.components.main-header')

    <title>User – Forget Password</title>
</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <div class="authentication-header"></div>
        <div class="authentication-forgot d-flex align-items-center justify-content-center">
            <div class="card forgot-box">
                <div class="card-body">
                    <div class="p-4 rounded">
                        <div class="text-center">
                            <img src="assets/images/icons/lock.png" width="120" alt="" />
                        </div>
                        <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                        <p class="text-muted">Enter your registered email ID to reset the password</p>
                        <form action="{{ route('forget.password') }}" method="POST">
                            @csrf
                            <div class="my-4">
                                <label class="form-label">Email Address</label>
                                <input type="text" name="email" class="form-control form-control-lg"
                                    placeholder="example@user.com" />
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Send</button>

                                <a href="{{ route('loginView') }}" class="btn btn-white btn-lg"><i
                                        class='bx bx-arrow-back me-1'></i>Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->
</body>

@include('layouts.components.footer')

</html>
