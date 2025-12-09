@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Add New User</h5>
                                </div>
                                <hr />
                                <form action="{{ route('user.update', $user->id) }}" method="POST">
                                    @csrf

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter Your Name" value="{{ old('name', $user->name ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">User Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="username"
                                                placeholder="Enter Username"
                                                value="{{ old('username', $user->username ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Email Address</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Email Address" value="{{ old('email', $user->email ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Phone No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="phone" placeholder="Phone No"
                                                value="{{ old('phone', $user->phone ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary px-4">Update User</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
