@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">

                <!-- Bill Form -->
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Bill Entry</h6>
                            <hr>
                            <form action="{{ isset($bill) ? route('bill.update', $bill->id) : route('bill.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($bill))
                                    @method('PUT')
                                @endif

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Month</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="month" name="month" class="form-control"
                                            value="{{ old('month', $bill->month ?? '') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Seat Rent</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" name="seat_rent" class="form-control"
                                            value="{{ old('seat_rent', $bill->seat_rent ?? 1500) }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Wifi</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" name="wifi" class="form-control"
                                            value="{{ old('wifi', $bill->wifi ?? '') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Khala</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" name="khala" class="form-control"
                                            value="{{ old('khala', $bill->khala ?? '') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Utility</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" name="utility_bill" class="form-control"
                                            value="{{ old('utility_bill', $bill->utility_bill ?? '') }}">
                                    </div>
                                </div>

                                <div class="row text-end">
                                    <div class="col-sm-12 text-secondary">
                                        <button type="submit" class="btn btn-primary px-4">
                                            {{ isset($bill) ? 'Update Bill' : 'Create Bill' }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Bill History Table -->
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Bill History</h6>
                            <hr>
                            <table class="table table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Seat Rent</th>
                                        <th>Wifi</th>
                                        <th>Khala</th>
                                        <th>Utility</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allBills as $bills)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($bills->month)->format('F Y') }}</td>
                                            <td>{{ $bills->seat_rent }}</td>
                                            <td>{{ $bills->wifi }}</td>
                                            <td>{{ $bills->khala }}</td>
                                            <td>{{ $bills->utility_bill }}</td>
                                            <td class="text-bold">{{ $bills->total + $bills->seat_rent }}</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{ route('bill.index', $bills->month) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('bill.delete', $bills->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Delete</button>
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
    </div>
@endsection
