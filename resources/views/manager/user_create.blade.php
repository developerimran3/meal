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
                                <div class="col-xl-12">
                                    @include('layouts.components.message')
                                </div>
                                <hr />
                                <form action="{{ route('user.create') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Enter Your Name"
                                                    value="{{ old('name') }}" name="name">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEnterYourUserName" class="col-sm-3 col-form-label">User
                                                Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Enter Your Name"
                                                    value="{{ old('username') }}" name="username">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmailAddress" class="col-sm-3 col-form-label">User Email
                                                Address</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" placeholder="Email Address"
                                                    value="{{ old('email') }}" name="email">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPhoneNo" class="col-sm-3 col-form-label">User Phone No</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Phone No"
                                                    value="{{ old('phone') }}" name="phone">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">User Role</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="role">
                                                    <option>Choose...</option>
                                                    <option value="member"{{ old('role') == 'member' ? 'selected' : '' }}>
                                                        Member
                                                    </option>
                                                    <option
                                                        value="accountant"{{ old('role') == 'accountant' ? 'selected' : '' }}>
                                                        Accountant</option>
                                                    <option
                                                        value="operations"{{ old('role') == 'operations' ? 'selected' : '' }}>
                                                        Operations</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputChoosePassword" class="col-sm-3 col-form-label">Choose
                                                Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" placeholder="Choose Password"
                                                    value="{{ old('password') }}" name="password">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-primary px-4">Create User</button>
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
