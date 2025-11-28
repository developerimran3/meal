@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-3">
                    @include('layouts.components.message')
                </div>
                <div class="col-lg-5">
                </div>
                <br>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-primary">Your Daily Meal Entry</h6>
                            <hr>
                            <form action="{{ isset($bazar) ? route('bazar.update', $bazar->id) : route('bazar.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($bazar))
                                    @method('PUT')
                                @endif
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="date" class="form-control" value="{{ $bazar->date ?? old('date') }}"
                                            name="date">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Breakfast</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" class="form-control" placeholder="Enter Amount"
                                            value="{{ $bazar->amount ?? old('amount') }}" name="amount">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Lunch</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" class="form-control" name="money_recipt">
                                        @if (isset($bazar))
                                            <img src="{{ asset('media/bazar/' . $bazar->money_recipt) }}" width="80">
                                        @endif
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-8"></div>
                                    <div class="col-sm-4 text-secondary">
                                        <button type="submit" class="btn btn-primary px-4">
                                            {{ isset($bazar) ? 'Update Bazar' : 'Create Bazar' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table align-middle">
                                    <h6 class="text-primary">Daily Bazar List</h6>
                                    <hr>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Recipt</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dailyBazar as $bazar)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ URL::to('media/bazar/' . $bazar->money_recipt) }}"
                                                        alt="" style="height: 50px; width:50px;"></td>
                                                <td>{{ $bazar->date }}</td>
                                                <td>{{ $bazar->amount }}</td>
                                                <td class="d-flex gap-2 p-4">
                                                    <a href="{{ route('bazar.show', $bazar->id) }}"
                                                        class="btn btn-sm btn-primary">View</a>
                                                    <a href="{{ route('bazar.view', $bazar->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('bazar.delete', $bazar->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure to delete this bazar?');">
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
    </div>
@endsection
