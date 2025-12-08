@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="{{ Auth::user()->photo ? asset('media/profile/' . Auth::user()->photo) : asset('/assets/images/demo.png') }}"
                                            class="rounded-circle p-1 bg-primary" width="100" height="100"
                                            alt="Admin">
                                        <div class="mt-3">
                                            <h4 class="text-capitalize">{{ Auth::user()->name }}</h4>
                                            <br>
                                            {{-- <button class="btn btn-primary">Follow</button>
                                            <button class="btn btn-outline-primary">Message</button> --}}
                                        </div>
                                    </div>

                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Email</h6>
                                            <span class="text-secondary">{{ Auth::user()->email }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Phone</h6>
                                            <span class="text-secondary">{{ Auth::user()->phone }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Role</h6>
                                            <span class="text-secondary text-capitalize">{{ Auth::user()->role }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Date Of Birth</h6>
                                            <span
                                                class="text-secondary">{{ Auth::user()->dob ? \Carbon\Carbon::parse(Auth::user()->dob)->format('d M Y') : 'Not Set' }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Set No</h6>
                                            <span
                                                class="text-secondary text-capitalize">{{ Auth::user()->set_no ? Auth::user()->set_no : 'Not Set' }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                                    name="name" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ Auth::user()->email }}"
                                                    name="email" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->phone }}" name="phone" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Date Of Birth</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input class="result form-control" type="date"
                                                    value="{{ Auth::user()->dob }}" name="dob">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Photo</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="file" class="form-control" name="photo" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <button type="submit" class="btn btn-primary px-4">Update
                                                    Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Change Password</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('password.update') }}" method="POST">
                                        @csrf
                                        <div class="form-group my-2">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <input type="password" name="current_password" id="current_password"
                                                class="form-control" placeholder="Enter your current password">
                                        </div>

                                        <div class="form-group my-2">
                                            <label for="password" class="form-label">New Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Enter new password">
                                        </div>

                                        <div class="form-group my-2">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation" class="form-control"
                                                placeholder="Enter confirm password">
                                        </div>

                                        <div class="form-group my-2 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
