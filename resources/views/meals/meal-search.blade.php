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
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="text-primary ">Total Meals: {{ $totalMeals }}</h5>
                                <h5 class="text-primary">Date: {{ $date }}</h5>
                            </div>
                            @include('layouts.components.message')
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Breakfast</th>
                                    <th>Lunch</th>
                                    <th>Dinner</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meals as $meal)
                                    <tr>
                                        <td>{{ $meal->date }}</td>
                                        <td>{{ $meal->user->name }}</td>
                                        <td class="text-capitalize">{{ $meal->user->role }}</td>
                                        <td>{{ $meal->breakfast }}</td>
                                        <td>{{ $meal->lunch }}</td>
                                        <td>{{ $meal->dinner }}</td>
                                        <td>{{ $meal->breakfast + $meal->lunch + $meal->dinner }}</td>
                                        <td>
                                            <form action="{{ route('meal.delete', $meal->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure to delete this meal?');">
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
@endsection
