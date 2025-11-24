@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-lg-4">
                <div class="col">
                    <div class="card radius-10 overflow-hidden bg-gradient-cosmic">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div>
                                    <p class="mb-0 text-white">Total Users</p>
                                    <h5 class="mb-0 text-white">{{ $user->count() }}</h5>
                                </div>
                                <div class="ms-auto text-white"><i class='bx bx-user font-30'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 overflow-hidden bg-gradient-burning">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div>
                                    <p class="mb-0 text-white">Total Income</p>
                                    <h5 class="mb-0 text-white">$52,945</h5>
                                </div>
                                <div class="ms-auto text-white"><i class='bx bx-wallet font-30'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 overflow-hidden bg-gradient-Ohhappiness">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div>
                                    <p class="mb-0 text-white">Total Users</p>
                                    <h5 class="mb-0 text-white">24.5K</h5>
                                </div>
                                <div class="ms-auto text-white"><i class='bx bx-bulb font-30'></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 overflow-hidden bg-gradient-moonlit">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div>
                                    <p class="mb-0 text-white">Comments</p>
                                    <h5 class="mb-0 text-white">869</h5>
                                </div>
                                <div class="ms-auto text-white"><i class='bx bx-chat font-30'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
            <div class="card radius-10">
                <div class="card-header border-bottom-0 bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="font-weight-bold mb-0">All Users</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle dataTable" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="product-img bg-transparent border">
                                                <img src="{{ $item->photo ? asset('media/profile/' . $item->photo) : asset('/assets/images/demo.png') }}"
                                                    class="p-1" alt="">
                                            </div>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td class="text-capitalize">{{ $item->role }}</td>
                                        <td><a
                                                class="text-capitalize btn btn-sm btn-primary radius-30">{{ $item->status }}</a>
                                        </td>
                                        <td>
                                            <a class="btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
