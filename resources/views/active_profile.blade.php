@extends('layouts.app')
@section('main')
    @if (Auth::user()->is_active == false)
        <div class="wrapper">
            <div class="authentication-header"></div>
            <div class="authentication-forgot d-flex align-items-center justify-content-center">
                <div class="card forgot-box">
                    <div class="card-body">
                        <div class="p-4 rounded">
                            <div class="text-center">
                                <img src="assets/images/icons/lock.png" width="120" alt="" />
                            </div>
                            <h4 class="mt-5 font-weight-bold text-danger">Please Active your Account?</h4>
                            <p class="text-muted">Enter your registered email ID to Active your Account</p>
                            <form action="{{ route('active.profile') }}" method="POST">
                                @csrf
                                <input type="hidden" name="active_token">

                                <div class="my-4">
                                    <label class="form-label">Email Address</label>
                                    <input type="text" name="email" class="form-control form-control-lg"
                                        placeholder="example@user.com" />
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">Active Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
