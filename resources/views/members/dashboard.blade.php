@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
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
                                    <p class="text-black">Meals Rate</p>
                                    <h5 class="text-primary">TK. {{ $mealRate }}</h5>
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
                                    <h5 class="text-primary">TK. 0.00</h5>
                                </div>
                                <div class="ms-auto text-primary"><i class='bx bx-chat font-30'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
