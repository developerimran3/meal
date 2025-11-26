@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Today All Meals</h6>
            <hr />
            <form action="{{ route('meals.search') }}" method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-2">
                        <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
