@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Bill Create -->
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">All User Bill Entry</h6>
                            <hr>
                            <br>
                            @include('layouts.components.message')
                            <form action="{{ route('bill.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Setect Month</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="month" name="month" class="form-control"
                                            value="{{ old('month') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Seat Rent</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" name="seat_rent" class="form-control"
                                            value="{{ old('seat_rent') ?? 1500 }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Wifi Bill</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" name="wifi" class="form-control"
                                            value="{{ old('wifi') }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Khala Bill</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" name="khala" class="form-control"
                                            value="{{ old('khala') }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Utility Bill</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" name="utility_bill" class="form-control"
                                            value="{{ old('utility_bill') }}" />
                                    </div>
                                </div>
                                <div class="row text-end">
                                    <div class="col-sm-12 text-secondary">
                                        <button type="submit" class="btn btn-primary px-4">Bill Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Bill History</h6>
                            <hr>
                            <table class="table align-middle ">
                                <thead>
                                    <tr class="text-center">
                                        <th>Month</th>
                                        <th>Seat Rent</th>
                                        <th>Wifi Bill</th>
                                        <th>Khala Bill</th>
                                        <th>Utility Bill</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bills as $bill)
                                        <tr class="text-center">
                                            <td>{{ \Carbon\Carbon::parse($bill->month)->format('M-Y') }} </td>
                                            <td>{{ $bill->seat_rent }} </td>
                                            <td>{{ $bill->wifi }} </td>
                                            <td>{{ $bill->khala }} </td>
                                            <td>{{ $bill->utility_bill }} </td>
                                            <td>{{ $bill->total }} </td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="" class="btn btn-sm btn-danger">Delete</a>
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
    </div>
@endsection
