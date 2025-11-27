@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row mt-5">
                <div class="col-lg-3">
                </div>
                {{-- Bazar --}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Your Daily Bazar Entry</h6>
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
                                        <input type="number" class="form-control" name="amount" />
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
                                    <div class="col-sm-9"></div>
                                    <div class="col-sm-3 text-secondary">
                                        <button type="submit" class="btn btn-primary px-4">Bazar Cost</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <div class="d-flex justify-content-between mb-4">
                                {{-- <h5 class="text-primary ">Total Meals: {{ $totalMeals }}</h5>
                                <h5 class="text-primary">Meals of Date: {{ $date }}</h5> --}}
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
                                {{-- @foreach ($meals as $meal)
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
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
