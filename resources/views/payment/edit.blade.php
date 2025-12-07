@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Bill Edit -->
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Bill Payment</h6>
                            @include('layouts.components.message')
                            <form action="{{ route('payment.update', $payEdit->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label>User</label>
                                    <input type="text" class="form-control" value="{{ $payEdit->user->name }}" disabled>
                                    <input type="hidden" name="user_id" value="{{ $payEdit->user_id }}">
                                </div>
                                <div class="mb-3">
                                    <label>Amount</label>
                                    <input type="number" name="amount" class="form-control"
                                        value="{{ $payEdit->amount }}">
                                </div>
                                <div class="mb-3">
                                    <label>Date</label>
                                    <input type="date" name="date" class="form-control" value="{{ $payEdit->date }}">
                                </div>
                                <button class="btn btn-primary">Update Pay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
