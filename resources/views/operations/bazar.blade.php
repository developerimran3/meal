@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row mt-5">
                {{-- Bazar --}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Your Daily Bazar Entry</h4>
                            <br>
                            <br>
                            @include('layouts.components.message')
                            <form action="{{ route('bazar.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input class="result form-control" type="date" name="date">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Total Bazer Cost</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="bazer_cost" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Money Recipt</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" class="form-control" name="money_recipt" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <button type="submit" class="btn btn-primary px-4">Bazar Cost</button>
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
