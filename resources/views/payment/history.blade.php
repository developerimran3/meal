@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <!-- Bill History Table -->
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Payment History {{ now()->format('F Y') }} </h6>
                            <br>
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentHistoryMonth as $payment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $payment->date }}</td>
                                            <td>{{ $payment->amount }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Total</th>
                                        <th> {{ $paymentHistoryMonth->sum('amount') }} </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Year {{ now()->format('Y') }} Payment History</h6>
                            <br>
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentHistoryYears as $payment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $payment->date }}</td>
                                            <td>{{ $payment->amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Total</th>
                                        <th> {{ $paymentHistoryYears->sum('amount') }} </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
