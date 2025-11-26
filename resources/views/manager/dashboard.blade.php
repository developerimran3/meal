@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-lg-4">
                <div class="col">
                    <div class="card radius-10 overflow-hidden ">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div>
                                    <p class="text-black">Total Users</p>
                                    <h5 class="text-primary">{{ $user->count() }}</h5>
                                </div>
                                <div class="ms-auto text-primary"><i class='bx bx-restaurant font-30'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card radius-10 overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div>
                                    <p class="text-black">Meals Rate</p>
                                    <h5 class="text-primary">TK. 60.00</h5>
                                </div>
                                <div class="ms-auto text-primary"><i class='bx bx-bulb font-30'></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div>
                                    <p class="text-black">Total Amount</p>
                                    <h5 class="text-primary">TK. 869.00</h5>
                                </div>
                                <div class="ms-auto text-primary"><i class='bx bx-chat font-30'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div>
                                    <p class="text-black">Total Payments</p>
                                    <h5 class="text-primary">TK. 869.00</h5>
                                </div>
                                <div class="ms-auto text-primary"><i class='bx bx-chat font-30'></i>
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
                    @include('layouts.components.message')
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle dataTable" id="example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>User Name</th>
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
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td class="text-capitalize">{{ $item->role }}</td>
                                        <td class="text-capitalize">{{ $item->status }}</td>
                                        <td>
                                            <form action="{{ route('user.delete', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>
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
