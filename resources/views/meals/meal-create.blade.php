@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            @if (in_array(Auth::user()->role, ['manager', 'operations', 'accountant']))
                <div class="row row-cols-1 row-cols-lg-4">
                    <div class="col">
                        <div class="card radius-10 overflow-hidden ">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div>
                                        <p class="text-black">My Total Meal</p>
                                        <h5 class="text-primary">Total: {{ $totalMeals }} meals</h5>
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
                                        <p class="text-black">Meal Rate</p>
                                        <h5 class="text-primary">Tk. {{ $mealRate }}</h5>
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
                                        <h5 class="text-primary">TK. {{ $mealCost }}</h5>
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
            @endif
            {{-- Meals --}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Your Daily Meal Entry</h6>
                            <hr>
                            <br>
                            @include('layouts.components.message')
                            <form action="{{ route('meal.store') }}" method="POST">
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
                                        <h6 class="mb-0">Breakfast</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" class="form-control" name="breakfast"value="1" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Lunch</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" class="form-control" name="lunch" value="1" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Dinner</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" class="form-control" name="dinner" value="1" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8"></div>
                                    <div class="col-sm-4 text-secondary">
                                        <button type="submit" class="btn btn-primary px-4">Meal Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Your Previous Meals</h6>
                            <hr>
                            <table class="table align-middle ">
                                <thead>
                                    <tr class="text-center">
                                        <th>Date</th>
                                        <th>Breakfast</th>
                                        <th>Lunch</th>
                                        <th>Dinner</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($meals as $meal)
                                        <tr class="text-center">
                                            <td>{{ \Carbon\Carbon::parse($meal->date)->format('d M Y') }} </td>
                                            <td>{{ $meal->breakfast }}</td>
                                            <td>{{ $meal->lunch }}</td>
                                            <td>{{ $meal->dinner }}</td>
                                            <td>{{ $meal->breakfast + $meal->lunch + $meal->dinner }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tr class="customs-table text-center ">
                                    <th>
                                        <h4 class="text-primary m-0">Total = </h4>
                                    </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <h4 class="text-primary m-0"> {{ $totalMeals }}</h4>
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
