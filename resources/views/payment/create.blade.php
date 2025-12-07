@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Bill Create -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Bill History</h6>
                            <h3>Monthly Overview ({{ $bill->month ?? now()->format('Y-m') }})</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Previous Due</th>
                                        <th>Meal Bill</th>
                                        <th>Total Bill</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($overview as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data['user']->name }}</td>
                                            <td>{{ number_format($data['prev_due'], 2) }}</td>
                                            <td>{{ number_format($data['meal_bill'], 2) }}</td>
                                            <td>{{ number_format($data['total_bill'], 2) }}</td>
                                            <td>{{ number_format($data['paid'], 2) }}</td>
                                            <td
                                                class="{{ $data['due'] > 0 ? 'text-danger fw-bold' : 'text-success fw-bold' }}">
                                                {{ number_format($data['due'], 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">History</h6>
                            <table class="table" id="example">
                                <thead>
                                    <tr>
                                        <th>History</th>
                                        <th>Name</th>
                                        <th>Pay Date</th>
                                        <th>Total Bill</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment as $cash)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($cash->created_at)->diffForHumans() }}</td>
                                            <td>{{ $cash['user']->name }}</td>
                                            <td>{{ $cash->date }}</td>
                                            <td>{{ number_format($cash['amount'], 2) }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-warning"
                                                    href="{{ route('payment.edit', $cash->id) }}">edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Bill Payment</h6>
                            <form action="{{ route('payment.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Amount</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select name="user_id" class="form-control">
                                            <option>Chose....</option>
                                            @foreach ($overview as $row)
                                                <option class="text-capitalize" value="{{ $row['user']->id }}">
                                                    {{ $row['user']->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Amount</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" name="amount" class="form-control" placeholder="Amount">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="date" name="date" class="form-control">
                                    </div>
                                </div>
                                <div class="row text-end">
                                    <div class="col-sm-12 text-secondary">
                                        <button type="submit" class="btn btn-primary px-4">Pay Cash</button>
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
