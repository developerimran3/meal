@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-xl-9"></div>
                <div class="col-xl-3">
                    @include('layouts.components.message')
                </div>
                <br>
                <hr />
                <br>
                <br>
                <div class="col-lg-5 ">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Role Change</h5>
                                </div>
                                <form action="{{ route('changeRoleUpdate') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">User
                                                Name & Role</label>
                                            <div class="col-sm-9">
                                                <select name="user_id" class="form-control">
                                                    @foreach ($user as $item)
                                                        <option class="text-capitalize" value="{{ $item->id }}">
                                                            {{ $item->name }} ===>
                                                            {{ $item->role }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Select Role</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="role">
                                                    <option>Choose...</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="accountant">Accountant</option>
                                                    <option value="operations">Operations</option>
                                                    <option value="member">Member</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-primary px-4">Change Role</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 ">
            </div>
            <div class="col-lg-5 ">
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Seat Change</h5>
                            </div>
                            <form action="{{ route('user.change.set') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">User
                                            Name & Role</label>
                                        <div class="col-sm-9">
                                            <select name="user_id" class="form-control">
                                                @foreach ($user as $item)
                                                    <option class="text-capitalize" value="{{ $item->id }}">
                                                        {{ $item->name }} ==Set No=>
                                                        {{ $item->set_no }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Set No</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="set_no">
                                                <option>Choose...</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary px-4">Change Seat</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
